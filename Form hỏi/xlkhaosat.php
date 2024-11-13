<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khaosatmomo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $ipAddress = $_SERVER['REMOTE_ADDR'];  // Lấy địa chỉ IP của người dùng

    // Kiểm tra xem email hoặc IP đã từng tham gia khảo sát chưa
    $checkUser = "SELECT * FROM nguoidung WHERE Email = '$email' OR DiaChiIP = '$ipAddress'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        // Nếu email hoặc IP đã tham gia khảo sát
        echo "<script>alert('Bạn đã tham gia khảo sát rồi.'); window.location.href = 'trang1.php';</script>";
    } else {
        // Nếu chưa tham gia, thêm thông tin người dùng vào bảng nguoidung
        $userId = uniqid();  // Tạo một ID người dùng duy nhất (hoặc có thể tự tạo ID theo cách khác)
        $status = 1;  // Trạng thái là đã hoàn thành khảo sát
        $now = date('Y-m-d H:i:s');  // Lấy thời gian hiện tại
        
        // Thêm thông tin người dùng vào bảng nguoidung
        $sqlInsertUser = "INSERT INTO nguoidung (MaNguoiDung, Email, DiaChiIP, TrangThai, ThoiGianHT, Tuoi, GioiTinh)
                          VALUES ('$userId', '$email', '$ipAddress', '$status', '$now', '$age', '$gender')";
        
        if ($conn->query($sqlInsertUser) === TRUE) {
            // Thêm câu trả lời vào bảng nguoidung_traloi
            // Chèn câu trả lời cho các câu hỏi
            $sqlInsertAnswers = "
                INSERT INTO nguoidung_traloi (MaNguoiDung, MaCauTraLoi) 
                SELECT '$userId', MaCauTraLoi
                FROM cautraloi
                WHERE MaCauHoi IN (1, 2, 3, 4)";  // Giả sử bạn có 4 câu hỏi, thay đổi MaCauHoi tương ứng

            if ($conn->query($sqlInsertAnswers) === TRUE) {
                echo "<script>alert('Cảm ơn bạn đã tham gia khảo sát!'); window.location.href = 'trang1.php';</script>";
            } else {
                echo "<script>alert('Lỗi khi lưu câu trả lời: " . $conn->error . "'); window.location.href = 'trang1.php';</script>";
            }
        } else {
            echo "<script>alert('Lỗi khi lưu thông tin người dùng: " . $conn->error . "'); window.location.href = 'trang1.php';</script>";
        }
    }
}

$conn->close();
?>
