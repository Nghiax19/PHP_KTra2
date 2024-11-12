-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2024 lúc 03:57 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `khaosatmomo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhoi`
--

CREATE TABLE `cauhoi` (
  `MaCauHoi` char(10) NOT NULL,
  `NoiDungCH` varchar(500) NOT NULL,
  `LoaiCH` tinyint(1) NOT NULL COMMENT '0: chung; 1: List 1; 2: List 2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cauhoi`
--

INSERT INTO `cauhoi` (`MaCauHoi`, `NoiDungCH`, `LoaiCH`) VALUES
('CH10', 'Các tương tác với ví điện tử được hướng dẫn rất rõ ràng và dễ hiểu', 2),
('CH11', 'MoMo dễ sử dụng, giao diện thân thiện người dùng', 2),
('CH12', 'Tất cả thông tin và giao dịch tài chính (thanh toán hóa đơn; mua hàng hóa online) trên mạng của tôi đều được bảo mật', 2),
('CH13', 'Tôi tin tưởng vào tính bảo mật của ví điện tử tôi đang sử dụng', 2),
('CH14', 'Tôi luôn chú ý đến các chương trình khuyến mãi khi tôi sử dụng MoMo', 2),
('CH15', 'Tôi tin là các chiến dịch khuyến mãi trên ví điện tử giúp tôi tiết kiệm được tiền', 2),
('CH5', 'Lý do anh/chị chưa từng sử dụng ví điện tử MoMo là gì?', 1),
('CH6', 'Điều gì có thể khiến anh/chị cân nhắc sử dụng ví điện tử MoMo trong tương lai?', 1),
('CH7', 'Anh/Chị thường thanh toán các giao dịch bằng phương thức nào?', 1),
('CH8', 'MoMo giúp tôi thanh toán dễ dàng hơn so với trước đây (khi tôi chưa sử dụng MoMo)', 2),
('CH9', 'Tôi nhận được thông tin tốt hơn (dễ và nhanh hơn) khi có sự thay đổi trong tài khoản của tôi', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cautraloi`
--

CREATE TABLE `cautraloi` (
  `MaCauTraLoi` char(10) NOT NULL,
  `MaCauHoi` char(10) NOT NULL,
  `NoiDungCTL` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cautraloi`
--

INSERT INTO `cautraloi` (`MaCauTraLoi`, `MaCauHoi`, `NoiDungCTL`) VALUES
('CTL10', 'CH4', 'Chưa từng sử dụng'),
('CTL11', 'CH4', 'Đang/Đã sử dụng'),
('CTL12', 'CH5', 'Chưa biết cách sử dụng ví điện tử'),
('CTL13', 'CH5', 'Không tin tưởng vào độ bảo mật của ví điện tử'),
('CTL14', 'CH5', 'Chưa thấy nhu cầu cần thiết'),
('CTL15', 'CH5', 'Không có khuyến mãi hoặc ưu đãi thu hút'),
('CTL16', 'CH6', 'An toàn bảo mật cao hơn'),
('CTL17', 'CH6', 'Có chương trình khuyến mãi, hoàn tiền'),
('CTL18', 'CH6', 'Phổ biến và dễ sử dụng hơn'),
('CTL19', 'CH6', 'Được nhiều cửa hàng và dịch vụ hỗ trợ thanh toán'),
('CTL20', 'CH7', 'Tiền mặt'),
('CTL21', 'CH7', 'Thẻ ngân hàng'),
('CTL22', 'CH7', 'Chuyển khoản'),
('CTL23', 'CH8', 'Hoàn toàn không đồng ý'),
('CTL24', 'CH8', 'Không đồng ý'),
('CTL25', 'CH8', 'Trung lập'),
('CTL26', 'CH8', 'Đồng ý'),
('CTL27', 'CH8', 'Hoàn toàn đồng ý'),
('CTL28', 'CH9', 'Hoàn toàn không đồng ý'),
('CTL29', 'CH9', 'Không đồng ý'),
('CTL30', 'CH9', 'Trung lập'),
('CTL31', 'CH9', 'Đồng ý'),
('CTL32', 'CH9', 'Hoàn toàn đồng ý'),
('CTL33', 'CH10', 'Hoàn toàn không đồng ý'),
('CTL34', 'CH10', 'Không đồng ý'),
('CTL35', 'CH10', 'Trung lập'),
('CTL36', 'CH10', 'Đồng ý'),
('CTL37', 'CH10', 'Hoàn toàn đồng ý'),
('CTL38', 'CH11', 'Hoàn toàn không đồng ý'),
('CTL39', 'CH11', 'Không đồng ý'),
('CTL40', 'CH11', 'Trung lập'),
('CTL41', 'CH11', 'Đồng ý'),
('CTL42', 'CH11', 'Hoàn toàn đồng ý'),
('CTL43', 'CH12', 'Hoàn toàn không đồng ý'),
('CTL44', 'CH12', 'Không đồng ý'),
('CTL45', 'CH12', 'Trung lập'),
('CTL46', 'CH12', 'Đồng ý'),
('CTL47', 'CH12', 'Hoàn toàn đồng ý'),
('CTL48', 'CH13', 'Hoàn toàn không đồng ý'),
('CTL49', 'CH13', 'Không đồng ý'),
('CTL50', 'CH13', 'Trung lập'),
('CTL51', 'CH13', 'Đồng ý'),
('CTL52', 'CH13', 'Hoàn toàn đồng ý'),
('CTL53', 'CH14', 'Hoàn toàn không đồng ý'),
('CTL54', 'CH14', 'Không đồng ý'),
('CTL55', 'CH14', 'Trung lập'),
('CTL56', 'CH14', 'Đồng ý'),
('CTL57', 'CH14', 'Hoàn toàn đồng ý'),
('CTL58', 'CH15', 'Hoàn toàn không đồng ý'),
('CTL59', 'CH15', 'Không đồng ý'),
('CTL60', 'CH15', 'Trung lập'),
('CTL61', 'CH15', 'Đồng ý'),
('CTL62', 'CH15', 'Hoàn toàn đồng ý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNguoiDung` char(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `DiaChiIP` varchar(50) NOT NULL,
  `TrangThai` tinyint(1) NOT NULL COMMENT '0: chưa hoàn thành, 1: đã hòan thành',
  `ThoiGianHT` datetime NOT NULL COMMENT 'Thời gian khách hoàn thành khảo sát\r\n',
  `Tuoi` tinyint(1) NOT NULL COMMENT '1: Dưới 18\r\n2: 18 - 24\r\n3: 25 - 34\r\n: 35 - 44\r\n: 45 - 54 \r\n6: 55 trở lên\r\n',
  `GioiTinh` tinyint(1) NOT NULL COMMENT '0: nam; 1: nữ; 2: khác'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaNguoiDung`, `Email`, `DiaChiIP`, `TrangThai`, `ThoiGianHT`, `Tuoi`, `GioiTinh`) VALUES
('ND1', 'user1@example.com', '192.168.1.1', 0, '2024-11-11 10:00:00', 2, 0),
('ND2', 'user2@example.com', '192.168.1.2', 1, '2024-11-11 10:05:00', 3, 1),
('ND3', 'user3@example.com', '192.168.1.3', 0, '2024-11-11 10:10:00', 6, 0),
('ND4', 'user4@example.com', '192.168.1.4', 1, '2024-11-11 10:15:00', 1, 1),
('ND5', 'user5@example.com', '192.168.1.5', 0, '2024-11-11 10:20:00', 3, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung_traloi`
--

CREATE TABLE `nguoidung_traloi` (
  `MaNguoiDung` char(10) NOT NULL,
  `MaCauTraLoi` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung_traloi`
--

INSERT INTO `nguoidung_traloi` (`MaNguoiDung`, `MaCauTraLoi`) VALUES
('ND1', 'CTL2'),
('ND1', 'CTL7'),
('ND1', 'CTL10'),
('ND1', 'CTL12'),
('ND1', 'CTL16'),
('ND1', 'CTL20'),
('ND2', 'CTL3'),
('ND2', 'CTL8'),
('ND2', 'CTL11'),
('ND2', 'CTL24'),
('ND2', 'CTL30'),
('ND2', 'CTL35'),
('ND2', 'CTL40'),
('ND2', 'CTL46'),
('ND2', 'CTL49'),
('ND2', 'CTL56'),
('ND2', 'CTL61'),
('ND3', 'CTL5'),
('ND3', 'CTL7'),
('ND3', 'CTL10'),
('ND4', 'CTL3'),
('ND4', 'CTL2'),
('ND4', 'CTL9'),
('ND4', 'CTL10'),
('ND4', 'CTL12'),
('ND4', 'CTL18'),
('ND4', 'CTL22'),
('ND5', 'CTL2'),
('ND5', 'CTL9');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD PRIMARY KEY (`MaCauHoi`);

--
-- Chỉ mục cho bảng `cautraloi`
--
ALTER TABLE `cautraloi`
  ADD PRIMARY KEY (`MaCauTraLoi`),
  ADD KEY `MaCauHoi` (`MaCauHoi`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `nguoidung_traloi`
--
ALTER TABLE `nguoidung_traloi`
  ADD KEY `MaCauTraLoi` (`MaCauTraLoi`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nguoidung_traloi`
--
ALTER TABLE `nguoidung_traloi`
  ADD CONSTRAINT `nguoidung_traloi_ibfk_2` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
