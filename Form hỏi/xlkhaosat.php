<?php
class App {
    public static function dieJson($data = []) {
        if(!$data) {
            $data = [
                'err' => true,
                'msg' => 'Data is empty'
            ];
        }
        die(json_encode($data));
    }
    public static function jsonErr($msg = null,$data = [],$err = true) {
        $json = [];
        $json['err'] = $err;
        if(!empty($data)) {
            $key = $err ? 'errors' : 'data';
            $json[$key] = $data;
        }
        if($msg) {
            $json['msg'] = $msg;
        }
        die(json_encode($json));
    }
    public static function Alert($msg = null, $data = [], $err = true) {
        echo '<script>
        alert("' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '");
        window.location.href = "trang1.php";
        </script>';
        exit();
    }
}
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
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $age = isset($_POST['age']) ? $_POST['age'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;
    $ipAddress = $_SERVER['REMOTE_ADDR'];  // Lấy địa chỉ IP của người dùng
    if(!$email) {     
        App::jsonErr('Bạn chưa nhập Email');
    }
    // Kiểm tra xem email đã từng tham gia khảo sát chưa
    $checkUser = "SELECT * FROM nguoidung WHERE Email = '$email'";
    $result = $conn->query($checkUser);
    if (!$result) {
        App::jsonErr("Lỗi truy vấn: " . $conn->error);
    }
    if ($result->num_rows > 0) {
        App::jsonErr('Bạn đã tham gia khảo sát rồi.');
    } else {
        if($action == 'checkmail') {
            App::jsonErr('Chưa tham gia khảo sát',[],false);
        }
        if(!$age){
            App::jsonErr('Bạn chưa nhập tuổi');
        }
        if(!$gender){
            App::jsonErr('Bạn chưa chọn giới tính');
        }
        $userId = time();  // Tạo một ID người dùng duy nhất (hoặc có thể tự tạo ID theo cách khác)
        $useStatus = isset($_POST['useStatus']) ? intval($_POST['useStatus']) : 0;
        $useType = 1;
        if($useStatus == 1) {
            $useType = 2;
        }
        $query = "SELECT * from cauhoi WHERE LoaiCH = $useType";
        $result = $conn->query($query);
        if (!$result || $result->num_rows == 0) {
            App::jsonErr("Dữ liệu câu hỏi không tồn tại");
        }
        $surveyArr = [];
        foreach ($result as $row) { 
            if(!isset($_POST[$row["MaCauHoi"]])) {
                App::jsonErr("Bạn chưa trả lời câu: ".$row['NoiDungCH']);
            }
            else {
                $surveyArr[$row['MaCauHoi']] = $_POST[$row["MaCauHoi"]];
            }
        }
        $answerArr = [];
        foreach ($surveyArr as $macauhoi => $cautraloi) {
            $query = "SELECT * FROM cautraloi WHERE MaCauHoi ='$macauhoi' AND NoiDungCTL = '$cautraloi'";
            $result = $conn->query($query);
            if (!$result || !$result->num_rows) {
                App::jsonErr("Câu trả lời không tồn tại");
            }
            else {
                $row = $result->fetch_assoc();
                $answerArr[] = $row['MaCauTraLoi'];
            }
        }
        $status = 1;  // Trạng thái là đã hoàn thành khảo sát
        $now = date('Y-m-d H:i:s');  // Lấy thời gian hiện tại
        
        // Thêm thông tin người dùng vào bảng nguoidung
        $sqlInsertUser = "INSERT INTO nguoidung (MaNguoiDung, Email, DiaChiIP, TrangThai, ThoiGianHT, Tuoi, GioiTinh)
                          VALUES ('$userId', '$email', '$ipAddress', '$status', '$now', '$age', '$gender')";
        if ($conn->query($sqlInsertUser) === TRUE) {
           foreach($answerArr as $key => $MaCauTraLoi) {
                $query = "INSERT INTO nguoidung_traloi (MaNguoiDung, MaCauTraLoi) VALUES ('$userId','$MaCauTraLoi')";
                $conn->query($query);
           }
            App::jsonErr("Cảm ơn bạn đã tham gia khảo sát",[],false);
            
        } else {
            App::jsonErr('Lỗi khi lưu thông tin người dùng: " . $conn->error . "');
        }
    }
}
else {
    App::jsonErr('Method is not valid');
}
$conn->close();
?>
