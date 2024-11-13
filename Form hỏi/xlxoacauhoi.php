<?php
include('connect.inp'); // Kết nối đến database

if (isset($_GET['MaCauHoi'])) {
    $macauhoi = $_GET['MaCauHoi'];

    // Bắt đầu transaction để đảm bảo đồng bộ giữa xóa câu hỏi và câu trả lời
    $con->begin_transaction();

    try {
        // Xóa tất cả câu trả lời liên quan đến câu hỏi trong bảng cautraloi
        $stmt_answers = $con->prepare("DELETE FROM cautraloi WHERE MaCauHoi = ?");
        $stmt_answers->bind_param("s", $macauhoi);
        $stmt_answers->execute();

        // Xóa câu hỏi trong bảng cauhoi
        $stmt_question = $con->prepare("DELETE FROM cauhoi WHERE MaCauHoi = ?");
        $stmt_question->bind_param("s", $macauhoi);
        $stmt_question->execute();

        // Commit transaction
        $con->commit();

        echo "<script>alert('Xóa thành công!'); window.location.href = 'admin.php';</script>";
    } catch (Exception $e) {
        // Nếu có lỗi xảy ra, rollback transaction
        $con->rollback();
        echo "<script>alert('Lỗi khi xóa câu hỏi!'); window.history.back();</script>";
    }

    $stmt_answers->close();
    $stmt_question->close();
    $con->close();
}
?>
