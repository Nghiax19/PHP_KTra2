<?php
    // Kết nối cơ sở dữ liệu
    include('connect.inp');

    // Kiểm tra nếu có dữ liệu gửi đến
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $maCauHoi = $_POST['MaCauHoi'];
        $noiDungCH = $_POST['editNoiDungCH'];
        $loaiCH = $_POST['editLoaiCH'];
        $answersua = $_POST['answersua']; // Mảng câu trả lời

        // Cập nhật bảng cauhoi
        $updateCauHoiQuery = "UPDATE cauhoi SET NoiDungCH = ?, LoaiCH = ? WHERE MaCauHoi = ?";
        $stmt = $con->prepare($updateCauHoiQuery);
        $stmt->bind_param("sss", $noiDungCH, $loaiCH, $maCauHoi);
        $stmt->execute();

        // Xóa các câu trả lời cũ trong bảng cautraloi
        $deleteAnswersQuery = "DELETE FROM cautraloi WHERE MaCauHoi = ?";
        $stmtDelete = $con->prepare($deleteAnswersQuery);
        $stmtDelete->bind_param("s", $maCauHoi);
        $stmtDelete->execute();

        // Thêm các câu trả lời mới vào bảng cautraloi
        $insertAnswerQuery = "INSERT INTO cautraloi (MaCauTraLoi, MaCauHoi, NoiDungCTL) VALUES (?, ?, ?)";
        $stmtInsertAnswer = $con->prepare($insertAnswerQuery);
        
        // Lặp qua các câu trả lời và thêm vào cơ sở dữ liệu
        foreach ($answersua as $index => $answer) {
            $maCauTraLoi = "CTL" . str_pad($index + 1, 4, "0", STR_PAD_LEFT);
            $stmtInsertAnswer->bind_param("sss", $maCauTraLoi, $maCauHoi, $answer);
            $stmtInsertAnswer->execute();
        }

        // Đóng các kết nối
        $stmt->close();
        $stmtDelete->close();
        $stmtInsertAnswer->close();
        $con->close();

        // Chuyển hướng hoặc trả về thông báo
        echo "<script>alert('Sửa câu hỏi thành công!'); window.location.href = 'admin.php';</script>";
    }
?>
