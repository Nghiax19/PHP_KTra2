<?php
include('connect.inp'); // Kết nối tới cơ sở dữ liệu

if (isset($_GET['MaCauHoi'])) {
    $macauhoi = $_GET['MaCauHoi'];

    // Truy vấn câu hỏi
    $stmt = $con->prepare("SELECT MaCauHoi, NoiDungCH, LoaiCH FROM cauhoi WHERE MaCauHoi = ?");
    $stmt->bind_param("s", $macauhoi);
    $stmt->execute();
    $result = $stmt->get_result();
    $question = $result->fetch_assoc();

    // Truy vấn các câu trả lời
    $stmt_answers = $con->prepare("SELECT NoiDungCTL FROM cautraloi WHERE MaCauHoi = ?");
    $stmt_answers->bind_param("s", $macauhoi);
    $stmt_answers->execute();
    $result_answers = $stmt_answers->get_result();
    $answers = [];
    while ($row = $result_answers->fetch_assoc()) {
        $answers[] = $row;
    }

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode([
        'MaCauHoi' => $question['MaCauHoi'],
        'NoiDungCH' => $question['NoiDungCH'],
        'LoaiCH' => $question['LoaiCH'],
        'CauTraLoi' => $answers
    ]);
}
?>
