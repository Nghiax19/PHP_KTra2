
<?php
include('connect.inp');

// Truy vấn để lấy số lượng câu trả lời cho từng câu hỏi
$sql = "SELECT 
    cauhoi.MaCauHoi, 
    cauhoi.NoiDungCH, 
    cautraloi.NoiDungCTL, 
    COUNT(nguoidung_traloi.MaNguoiDung) as answer_count 
FROM nguoidung_traloi 
JOIN cautraloi ON nguoidung_traloi.MaCauTraLoi = cautraloi.MaCauTraLoi 
JOIN cauhoi ON cautraloi.MaCauHoi = cauhoi.MaCauHoi 
GROUP BY cauhoi.MaCauHoi, cauhoi.NoiDungCH, cautraloi.NoiDungCTL
ORDER BY CAST(SUBSTRING(cauhoi.MaCauHoi, 3, CHAR_LENGTH(cauhoi.MaCauHoi) - 2) AS UNSIGNED);";

$result = $con->query($sql);
$chartData = [];

// Xử lý kết quả truy vấn và lưu vào mảng
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $maCauHoi = $row['NoiDungCH'];
        $chartData[$maCauHoi][] = [
            'label' => $row['NoiDungCTL'],
            'count' => $row['answer_count']

        ];
    }
}

// Chuyển dữ liệu PHP sang JavaScript
echo "<script> var chartData = " . json_encode($chartData) . ";</script>";

?>