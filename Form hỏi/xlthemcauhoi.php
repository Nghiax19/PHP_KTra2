<?php
include('connect.inp'); // Kết nối đến database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $noidungch = $_POST['noidungch'];
    $loaich = $_POST['loaich'];
    $answers = $_POST['answers'];

    // Tạo MaCauHoi tự động với định dạng CHxxxx
    $result = $con->query("SELECT MAX(CAST(SUBSTRING(MaCauHoi, 3) AS UNSIGNED)) AS max_id FROM cauhoi");
    $row = $result->fetch_assoc();
    $new_id = $row['max_id'] + 1;
    $macauhoi = 'CH' . str_pad($new_id, 4, '0', STR_PAD_LEFT);

    // Lưu câu hỏi vào bảng cauhoi
    $stmt = $con->prepare("INSERT INTO cauhoi (MaCauHoi, NoiDungCH, LoaiCH) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $macauhoi, $noidungch, $loaich);
    if ($stmt->execute()) {
        // Nếu lưu câu hỏi thành công, lưu các câu trả lời vào bảng cautraloi
        foreach ($answers as $index => $answer) {
            // Tạo MaCauTraLoi tự động với định dạng CTLxxxx
            $result = $con->query("SELECT MAX(CAST(SUBSTRING(MaCauTraLoi, 4) AS UNSIGNED)) AS max_id FROM cautraloi");
            $row = $result->fetch_assoc();
            $new_answer_id = $row['max_id'] + 1;
            $macautraloi = 'CTL' . str_pad($new_answer_id, 4, '0', STR_PAD_LEFT);

            // Lưu từng câu trả lời với MaCauHoi tương ứng
            $stmt_answer = $con->prepare("INSERT INTO cautraloi (MaCauTraLoi, MaCauHoi, NoiDungCTL) VALUES (?, ?, ?)");
            $stmt_answer->bind_param("sss", $macautraloi, $macauhoi, $answer);
            $stmt_answer->execute();
        }
        
        echo "<script>alert('Thêm thành công!'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm câu hỏi!'); window.history.back();</script>";
    }

    $stmt->close();
    $con->close();
}
?>
