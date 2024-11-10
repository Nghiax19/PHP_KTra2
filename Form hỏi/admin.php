<?php
session_start(); 
if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit();
}
?><!DOCTYPE html>
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
        <table class="table">
          <tr>
            <th>STT</th>
            <th>Câu hỏi</th>
            <th>Loại câu trả lời</th>
            <th>Hành động</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Bạn có hài lòng với dịch vụ của chúng tôi?</td>
            <td>Trắc nghiệm</td>
            <td>
              <button class="btn" onclick="openModal('edit')">Sửa</button>
              <button class="btn" onclick="deleteQuestion()">Xóa</button>
            </td>
          </tr>
          <!-- Thêm nhiều dòng câu hỏi tại đây -->
        </table>
    </div>

    <!-- Modal thêm và sửa câu hỏi -->
<div id="modal" class="modal">
    <div class="modal-content">
      <h3 id="modalTitle">Thêm Câu hỏi</h3>
      <label>Câu hỏi:</label><br>
      <input type="text" id="questionInput" style="width: 100%;"><br><br>
      <label>Loại câu trả lời:</label><br>
      <select id="answerType">
        <option value="Trắc nghiệm">Trắc nghiệm</option>
        <option value="Tự luận">Tự luận</option>
        <option value="Đa lựa chọn">Đa lựa chọn</option>
      </select><br><br>
      <button class="btn" onclick="saveQuestion()">Lưu</button>
      <button class="btn" onclick="closeModal()">Hủy</button>
    </div>
  </div>

  <script>
    function openModal(action) {
      document.getElementById('modal').style.display = 'block';
      document.getElementById('modalTitle').innerText = action === 'add' ? 'Thêm Câu hỏi' : 'Sửa Câu hỏi';
    }
  
    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }
  
    function saveQuestion() {
      // Thêm logic lưu câu hỏi ở đây
      alert('Câu hỏi đã được lưu!');
      closeModal();
    }
  
    function deleteQuestion() {
      // Thêm logic xóa câu hỏi ở đây
      if (confirm('Bạn có chắc muốn xóa câu hỏi này không?')) {
        alert('Câu hỏi đã được xóa!');
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