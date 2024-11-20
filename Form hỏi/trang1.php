<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khảo Sát Ví Điện Tử</title>
    <link rel="stylesheet" href="survey.css">
</head>
<body>
    <div class="survey-wrap">
        <!-- Giao diện bắt đầu -->
        <div class="survey-container" id="survey-container">
            <img src="MoMo_Logo.png" alt="">
            <h2>HÀNH VI SỬ DỤNG VÍ ĐIỆN TỬ MOMO</h2>
            <p>Cảm ơn bạn đã click vào bảng câu hỏi khảo sát về "Hành vi sử dụng ví điện tử ở Việt Nam" được phát triển bởi
                Nhóm 12 - Học viện Ngân Hàng. Rất mong nhận được sự hợp tác của bạn! <br>Chân thành cảm ơn.</p>
            <div class="button-container">
                <button class="start-button" onclick="startSurvey()">BẮT ĐẦU <span>→</span></button>
            </div>
        </div>
        <!-- Giao diện form khảo sát -->
        <div id="survey-form" style="display: none;">
            <h2>Khảo Sát</h2>
                <form id="userinfo" onsubmit="return false;">
                    <!-- form nhập thông tin người dùng -->
                    <div id="buoc1">
                        <?php
                        $conn = new mysqli("localhost", "root", "", "khaosatmomo");
                        if ($conn->connect_error) {
                            die("Kết nối thất bại: " . $conn->connect_error);
                        }
                        $sql = "SELECT MaCauHoi, NoiDungCH FROM cauhoi WHERE LoaiCH = 0";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<label for='" . $row['MaCauHoi'] . "'>" . $row['NoiDungCH'] . ":</label><br>";

                                if ($row['MaCauHoi'] == 'CH2') {
                                    $age_sql = "SELECT NoiDungCTL FROM cautraloi WHERE MaCauHoi = 'CH2'";
                                    $age_result = $conn->query($age_sql);
                                    echo "<select name='age' id='age' required>";
                                    echo "<option value='' disabled selected>Chọn câu trả lời</option>";
                                    while ($age_row = $age_result->fetch_assoc()) {
                                        echo "<option value='" . strtolower($age_row['NoiDungCTL']) . "'>" . $age_row['NoiDungCTL'] . "</option>";
                                    }
                                    echo "</select><br><br>";
                                } elseif ($row['MaCauHoi'] == 'CH3') {
                                    $gender_sql = "SELECT NoiDungCTL FROM cautraloi WHERE MaCauHoi = 'CH3'";
                                    $gender_result = $conn->query($gender_sql);
                                    echo "<select name='gender' id='gender' required>";
                                    echo "<option value='' disabled selected>Chọn câu trả lời</option>";
                                    while ($gender_row = $gender_result->fetch_assoc()) {
                                        echo "<option value='" . strtolower($gender_row['NoiDungCTL']) . "'>" . $gender_row['NoiDungCTL'] . "</option>";
                                    }
                                    echo "</select><br><br>";
                                    
                                } elseif ($row['MaCauHoi'] == 'CH4') {
                                    $chd_sql = "SELECT NoiDungCTL FROM cautraloi WHERE MaCauHoi = 'CH4'";
                                    $chd_result = $conn->query($chd_sql);
                                    echo "<select name='CHD' id='CHD' required>";
                                    echo "<option value='' disabled selected>Chọn câu trả lời</option>";
                                    while ($chd_row = $chd_result->fetch_assoc()) {
                                        echo "<option value='" . strtolower($chd_row['NoiDungCTL']) . "'>" . $chd_row['NoiDungCTL'] . "</option>";
                                    }
                                    echo "</select><br><br>";
                                } else {
                                    echo "<input type='email' name='email' id='email' required><br><br>";
                                }
                            }
                        } else {
                            echo "Không có câu hỏi.";
                        }
                        ?>
                        <div class="button-container">
                            <button type="submit">TIẾP TỤC <span>→</span></button>
                        </div>
                    </div>
                </form>
                <!-- form nhập thông tin khảo sát -->
                <div id="buoc2" style="display: none;">
                    <form class="formkhaosat" id="dasudung" style="display: none;" method="POST" onsubmit="return false;">
                        <h4>Anh/Chị đã từng sử dụng MoMo. Vui lòng trả lời các câu hỏi sau nhằm thu thập thông tin</h4>
                        <div class="dasudung-wrap">
                            <?php
                            $questions = ['CH8', 'CH9', 'CH10', 'CH11', 'CH12', 'CH13', 'CH14', 'CH15'];
                            foreach ($questions as $qCode) {
                                $sql = "SELECT NoiDungCH FROM cauhoi WHERE MaCauHoi = '$qCode'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<label for='" . $qCode . "'>" . $row['NoiDungCH'] . ":</label><br>";
                                        // Truy vấn câu trả lời cho câu hỏi
                                        $answer_sql = "SELECT NoiDungCTL FROM cautraloi WHERE MaCauHoi = '$qCode'";
                                        $answer_result = $conn->query($answer_sql);
                                        if ($answer_result->num_rows > 0) {
                                            echo "<select name='" . $qCode . "' id='" . $qCode . "' required>";
                                            echo "<option value='' disabled selected>Chọn câu trả lời</option>";
                                            while ($answer_row = $answer_result->fetch_assoc()) {
                                                echo "<option value='" . strtolower($answer_row['NoiDungCTL']) . "'>" . $answer_row['NoiDungCTL'] . "</option>";
                                            }
                                            echo "</select><br><br>";
                                        }
                                    }
                                }
                            }
                            ?>
                            <button type="submit">GỬI</button>
                        </div>
                    </form>
                    <form class="formkhaosat" id="chuasudung" style="display: none;" method="POST" onsubmit="return false;">
                    <h4>Anh/Chị chưa từng sử dụng MoMo. Vui lòng trả lời các câu hỏi sau nhằm thu thập thông tin </h4>
                        <div class="chuasudung-wrap">
                            <?php
                            $questions = ['CH5', 'CH6', 'CH7'];
                            foreach ($questions as $qCode) {
                                $sql = "SELECT NoiDungCH FROM cauhoi WHERE MaCauHoi = '$qCode'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<label for='" . $qCode . "'>" . $row['NoiDungCH'] . ":</label><br>";
                                        // Truy vấn câu trả lời cho câu hỏi
                                        $answer_sql = "SELECT NoiDungCTL FROM cautraloi WHERE MaCauHoi = '$qCode'";
                                        $answer_result = $conn->query($answer_sql);
                                        if ($answer_result->num_rows > 0) {
                                            echo "<select name='" . $qCode . "' id='" . $qCode . "' required>";
                                            echo "<option value='' disabled selected>Chọn câu trả lời</option>";
                                            while ($answer_row = $answer_result->fetch_assoc()) {
                                                echo "<option value='" . strtolower($answer_row['NoiDungCTL']) . "'>" . $answer_row['NoiDungCTL'] . "</option>";
                                            }
                                            echo "</select><br><br>";
                                        }
                                    }
                                }
                            }
                            ?>
                            <button type="submit">GỬI</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
    <script>
        let useStatus = true;
        const surveyData = new FormData();
        document.addEventListener('DOMContentLoaded', () => {
            const formuserinfo = document.getElementById('userinfo');
            const formdasudung = document.getElementById('dasudung');
            const formchuasudung = document.getElementById('chuasudung');
            Array.from(document.getElementsByClassName('formkhaosat')).forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const formData = new FormData(form);
                    for (const [key, value] of formData.entries()) {
                        surveyData.append(key, value);
                    }
                    surveyData.append('useStatus',useStatus ? 1 : 0);
                    fetch('xlkhaosat.php', {
                        method: 'POST',
                        body: surveyData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data?.msg) {
                            return alert(data.msg);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi gửi dữ liệu!');
                    });
                })
            });
            formuserinfo.addEventListener('submit', (e) => {
                const formData = new FormData();
                formData.append('action', 'checkmail');
                formData.append('email', document.querySelector('input[name="email"]').value);
                fetch('xlkhaosat.php', {
                    method: 'POST', // Phương thức gửi POSTs
                    body: formData
                })
                .then(response => response.json()) // Xử lý phản hồi từ server dưới dạng JSON
                .then(data => {
                    if(data.err) {
                        return alert(data.msg);
                    }
                    surveyData.append('email', document.getElementById('email').value);
                    surveyData.append('age', document.getElementById('age').value);
                    surveyData.append('gender', document.getElementById('gender').value);
                    surveyData.append('CHD', document.getElementById('CHD').value);
                    const dropdown = document.getElementById("CHD");
                    const selectedCH4 = dropdown.options[dropdown.selectedIndex].text;
                    document.getElementById('buoc1').style.display = 'none';
                    document.getElementById('buoc2').style.display = 'block';
                    if (selectedCH4 === 'Chưa từng sử dụng') {
                        useStatus = false;
                        document.getElementById("chuasudung").style.display = "block";
                        document.getElementById("dasudung").style.display = "none";
                    } else if (selectedCH4 === 'Đang/Đã sử dụng') {
                        useStatus = true;
                        document.getElementById("chuasudung").style.display = "none";
                        document.getElementById("dasudung").style.display = "block";
                    } else {
                        alert("Lỗi: Không tìm thấy form phù hợp cho lựa chọn của bạn.");
                    }
                    return;
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi gửi dữ liệu!');
                });
            })
        });
        function startSurvey() {
            document.getElementById("survey-container").style.display = 'none';
            document.getElementById("survey-form").style.display = 'block';
        }
    </script>
    <?php
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
?>
</body>

</html> 