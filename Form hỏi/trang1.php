<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khảo Sát Ví Điện Tử</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #283593;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .survey-container {
            background-color: #1a237e;
            color: white;
            width: 90%;
            max-width: 500px;
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .survey-container img {
            width: 80px;
            margin-bottom: 20px;
        }
        .survey-container h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            margin-bottom: 20px;
        }
        .survey-container p {
            font-size: 16px;
            color: #b0bec5;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .button-container {
            display: flex;
            justify-content: center;
        }
        .start-button {
            background-color: #ff4081;
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .start-button:hover {
            background-color: #f50057;
        }
        .start-button span {
            font-size: 20px;
        }
        /* Survey form styles */
        #survey-form {
            background-color: #1a237e;
            color: white;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            text-align: left;
        }
        #survey-form h2 {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        #survey-form label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }
        #survey-form input[type="email"], 
        #survey-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #3f51b5;
            background-color: #303f9f;
            color: white;
            font-size: 16px;
        }
        #survey-form select {
            cursor: pointer;
        }
        #survey-form button {
            background-color: #ff4081;
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 20px;
        }
        #survey-form button:hover {
            background-color: #f50057;
        }
    </style>
</head>
<body>

<div class="survey-container" id="survey-container">
    <img src="MoMo_Logo.png" alt="">
    <h2>HÀNH VI SỬ DỤNG VÍ ĐIỆN TỬ Ở VIỆT NAM</h2>
    <p>Cảm ơn bạn đã click vào bảng câu hỏi khảo sát về "Hành vi sử dụng ví điện tử ở Việt Nam" được phát triển bởi Nhóm 12 - Học viện Ngân Hàng. Rất mong nhận được sự hợp tác của bạn! Chân thành cảm ơn.</p>
    <div class="button-container">
        <button class="start-button" onclick="startSurvey()">START <span>→</span></button>
    </div>
</div>

<div id="survey-form" style="display:none;">
    <h2>Khảo Sát</h2>
    <form id="survey" method="POST" action="xlkhaosat.php">
<?php
        // Kết nối cơ sở dữ liệu và lấy câu hỏi từ bảng 'cauhoi'
        $conn = new mysqli("localhost", "root", "", "khaosatmomo");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn các câu hỏi
        $sql = "SELECT MaCauHoi, NoiDungCH FROM cauhoi WHERE LoaiCH = 0";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<label for='" . $row['MaCauHoi'] . "'>" . $row['NoiDungCH'] . ":</label><br>";

                if ($row['MaCauHoi'] == 'CH2') { // Câu hỏi tuổi
                    echo "<select name='age' id='age'>
                            <option value='under_18'>Dưới 18</option>
                            <option value='18_24'>18 - 24</option>
                            <option value='25_34'>25 - 34</option>
                            <option value='35_44'>35 - 44</option>
                            <option value='45_54'>45 - 54</option>
                            <option value='55_up'>55 trở lên</option>
                          </select><br><br>";
                } elseif ($row['MaCauHoi'] == 'CH3') { // Câu hỏi giới tính
                    echo "<select name='gender' id='gender'>
                            <option value='male'>Nam</option>
                            <option value='female'>Nữ</option>
                            <option value='other'>Khác</option>
                          </select><br><br>";
                } else { // Câu hỏi email
                    echo "<input type='email' name='email' id='email' required><br><br>";
                }
            }
        } else {
            echo "Không có câu hỏi.";
        }
        $conn->close();
?>
        
        <button type="submit">Gửi</button>
    </form>
</div>

<script>
    function startSurvey() {
        document.getElementById("survey-container").style.display = "none";
        document.getElementById("survey-form").style.display = "block";
    }
</script>

</body>
</html>
