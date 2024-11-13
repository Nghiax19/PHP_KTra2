<?php 
session_start(); 
if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Trang quản lý câu hỏi</title>
</head>
<body>
    <div class="header">Quản trị câu hỏi khảo sát</div>
    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="#">Quản lý Câu hỏi</a>
        <a href="#">Kết quả Khảo sát</a>
        <a href="#">Cài đặt</a>
        <a href="#">
          <form action="xldangxuat.php" method="POST">
          <button type="submit" >Đăng xuất</button>
          </form>
        </a>
    </div>

    <div class="content">
        <h2>Quản lý Câu hỏi</h2>
        <button class="btn" onclick="openModal('add')">Thêm Câu hỏi</button>

                <!-- Modal thêm câu hỏi -->
        <div id="modal" class="modal">
            <div class="modal-content">
              <h3 id="modalTitle">Thêm Câu hỏi</h3>
              <form method="POST" action="xlthemcauhoi.php">
              <label>Nội dung câu hỏi</label><br>
              <input type="text" name="noidungch" style="width: 100%;"><br><br>
              <label>Loai cau hoi</label><br>
              <input type="text" name="loaich" style="width: 100%;"><br><br>
                <!-- Phần thêm câu trả lời -->
                  <label>Câu trả lời</label><br>
                  <div id="answersContainer">
                      <div class="answer">
                          <input type="text" name="answers[]" placeholder="Câu trả lời 1" style="width: 100%;"><br><br>
                      </div>
                  </div>
                  <button type="button" onclick="addAnswer()">Thêm câu trả lời</button><br><br>
                <!-- /Phần thêm câu trả lời -->
              <button class="btn" type="submit">Lưu</button>
              <button class="btn" type="button" onclick="closeModal()">Hủy</button>
            </form>
                
              
            </div>
          </div>

          <!-- Hiển thị bảng câu hỏi lên đây --> 
        <table class="table">
            <tr>
                <th>STT</th>
                <th>Mã câu hỏi</th>
                <th>Nội dung câu hỏi</th>
                <th>Câu trả lời</th>
                <th>Loại câu hỏi</th>
                <th></th>
            </tr>
            
            <?php
            // Kết nối cơ sở dữ liệu
            include('connect.inp');

            // Truy vấn lấy tất cả câu hỏi từ bảng cauhoi và các câu trả lời từ bảng cautraloi
            $query = "
                SELECT c.MaCauHoi, c.NoiDungCH, c.LoaiCH, GROUP_CONCAT(ct.NoiDungCTL SEPARATOR ', ') as CacCauTraLoi
                FROM cauhoi c
                LEFT JOIN cautraloi ct ON c.MaCauHoi = ct.MaCauHoi
                GROUP BY c.MaCauHoi, c.NoiDungCH, c.LoaiCH
            ";

            $result = $con->query($query);
            $stt = 1; // Biến đếm cho cột STT

            // Kiểm tra và hiển thị dữ liệu từ bảng cauhoi
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $stt++ . "</td>"; // Tăng STT tự động
                    echo "<td>" .$row['MaCauHoi'] . "</td>";
                    echo "<td>" .$row['NoiDungCH']. "</td>";
                    echo "<td>" .$row['CacCauTraLoi']. "</td>";
                    echo "<td>" .$row['LoaiCH']. "</td>";
                    echo "<td>
                            <button class='btn' onclick=\"openEditModal('{$row['MaCauHoi']}')\">Sửa</button>
                            <button class='btn' onclick=\"confirmDelete('{$row['MaCauHoi']}')\">Xóa</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có câu hỏi nào</td></tr>";
            }

            // Đóng kết nối
            $con->close();
            ?>
        </table>

      <!-- Modal Sửa câu hỏi -->
      <div id="Modalsua" class="modal">
          <div class="modal-content">
            <h3 id="modalTitle">Sửa câu hỏi</h3>
              <form id="editQuestionForm" method="POST" action="xlsuacauhoi.php">
              <input type="hidden" id="MaCauHoi" name="MaCauHoi">
                <label for="editNoiDungCH">Nội dung câu hỏi</label><br>
                <input id="editNoiDungCH" name="editNoiDungCH" style="width: 100%;"><br><br>
                <label for="editLoaiCH">Loại câu hỏi</label><br>
                <input type="text" id="editLoaiCH" name="editLoaiCH" style="width: 100%;"><br><br>
                <label for="editNoiDungCTL">Câu trả lời</label><br>
                <!-- Phần thêm câu trả lời -->
            <div id="answersContainersua">
                <div class="answersua">
                    <input type="text" name="answersua[]" placeholder="Câu trả lời 1" style="width: 100%;"><br><br>
                </div>
            </div>
            <button type="button" onclick="addAnswersua()">Thêm câu trả lời</button><br><br>
            <!-- /Phần thêm câu trả lời -->
                  <button type="submit" class="btn">Lưu</button>
                  <button type="button" class="btn" onclick="closesua()">Hủy</button>
              </form>
              
          </div>
      </div>
            <!-- /Modal Sửa câu hỏi -->


</div>

    

  <script>
    //Modal thêm câu hỏi
    function openModal(action) {
      document.getElementById('modal').style.display = 'block';
      document.getElementById('modalTitle').innerText = action === 'add' ? 'Thêm Câu hỏi' : 'Sửa Câu hỏi';
    }
    //Thêm câu hỏi
    function addAnswer() {
    var answersContainer = document.getElementById('answersContainer');
    var newAnswer = document.createElement('div');
    newAnswer.classList.add('answer');
    newAnswer.innerHTML = '<input type="text" name="answers[]" placeholder="Câu trả lời mới" style="width: 100%;"><br><br>';
    answersContainer.appendChild(newAnswer);
}

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
  

    // Hàm mở modal và hiển thị dữ liệu câu hỏi
function openEditModal(MaCauHoi) {
    // Gửi yêu cầu AJAX để lấy dữ liệu câu hỏi
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'nhapttmodal.php?MaCauHoi=' + MaCauHoi, true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.error) {
                alert(response.error);
                return;
            }

            // Điền dữ liệu vào các trường trong modal
            document.getElementById('MaCauHoi').value = response.MaCauHoi;
            document.getElementById('editNoiDungCH').value = response.NoiDungCH;
            document.getElementById('editLoaiCH').value = response.LoaiCH;

            // Mở modal
            document.getElementById('Modalsua').style.display = 'block';
        }
    };
    xhr.send();
}

  // Hàm thêm câu trả lời mới
function addAnswersua() {
    var newAnswer = document.createElement('div');
    newAnswer.classList.add('answersua');
    newAnswer.innerHTML = '<input type="text" name="answersua[]" placeholder="Câu trả lời mới" style="width: 100%;"><br><br>';
    document.getElementById('answersContainersua').appendChild(newAnswer);
}
    
function closesua() {
        document.getElementById('Modalsua').style.display = 'none';
    }


  // Nút Xóa
function confirmDelete(MaCauHoi) {
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        // Nếu bấm OK, sẽ gọi xóa câu hỏi với MaCauHoi tương ứng
        window.location.href = 'xlxoacauhoi.php?MaCauHoi=' + MaCauHoi;
    }
}
  
    // Đóng modal khi click ra ngoài
    window.onclick = function(event) {
      if (event.target == document.getElementById('modal')) {
        closeModal();
      }
    }
  </script>
  
</body>
</html>