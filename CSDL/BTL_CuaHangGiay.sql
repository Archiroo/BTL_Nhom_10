CREATE DATABASE BTL_CuaHangGiay
USE BTL_CuaHangGiay
--Bảng nhà cung cấp
CREATE TABLE NHACUNGCAP(
	Ma_ncc CHAR(10) not null PRIMARY KEY,
	Ten_ncc NVARCHAR(100),
	SDT_ncc CHAR(15),
	Diachi_ncc NVARCHAR(100),
	Tinh_trang BIT DEFAULT 1)
--Bảng Sản phẩm
CREATE TABLE SANPHAM(
	Ma_sp CHAR(10) not null PRIMARY KEY,
	Ten_sp NVARCHAR(100),
	Mo_ta CHAR(50),
	Gia_nhap FLOAT,
	Gia_ban FLOAT,
	So_luongTon INT,
	Ma_ncc CHAR(10),
	Tinh_trang BIT DEFAULT 1,
	FOREIGN KEY(Ma_ncc) REFERENCES NHACUNGCAP(Ma_ncc))
--Bảng Nhân viên
CREATE TABLE NHANVIEN(
	Ma_nv CHAR(10) not null PRIMARY KEY,
	Ten_nv NVARCHAR(100),
	Gioi_tinh BIT,
	Ngay_sinh DATE,
	Chuc_vu NVARCHAR(100),
	Dia_chi NVARCHAR(100),
	So_dt CHAR(15),
	Mo_ta CHAR(30),
	Tinh_trang BIT DEFAULT 1)
--Bảng lương
CREATE TABLE Luong(
	Ma_nv CHAR(10),
	So_ngayLam INT,
	Muc_luong FLOAT,
	
	FOREIGN KEY(Ma_nv) REFERENCES NHANVIEN(Ma_nv))
--Bảng Khách hàng

CREATE TABLE KHACHHANG(
	Ma_khach CHAR(10) not null PRIMARY KEY,
	Ten_khach NVARCHAR(100),
	Gioi_tinh BIT,
	So_dienThoai CHAR(100),
	Tinh_trang BIT DEFAULT 1)
--Bảng shipper
CREATE TABLE NHAVANCHUYEN(
	Ma_nvc CHAR(10) not null PRIMARY KEY,
	Ten_nvc NVARCHAR(100),
	SDT_nvc CHAR(15),
	Tinh_trang BIT DEFAULT 1)
--Bảng Hóa đơn
CREATE TABLE HOADON(
	Ma_hoadon INT IDENTITY(1,1) not null PRIMARY KEY,
	Ngay_hoadon DATE,
	Ma_nv CHAR(10),
	Ma_khach CHAR(10),
	Ma_nvc CHAR(10),
	Dia_chinhan NVARCHAR(100),
	Phi_ship FLOAT,
	Tinh_trang BIT DEFAULT 1,
	
	FOREIGN KEY (Ma_nv) REFERENCES NHANVIEN(Ma_nv),
	FOREIGN KEY (Ma_khach) REFERENCES KHACHHANG(Ma_khach),
	FOREIGN KEY (Ma_nvc) REFERENCES NHAVANCHUYEN(Ma_nvc))
--Bảng Chi tiết hóa đơn
SELECT * FROM CHITIETHD
CREATE TABLE CHITIETHD(
	Ma_hoadon INT,
	Ma_sp CHAR(10),
	So_luongBan INT,
	Tinh_trang BIT DEFAULT 1,
	FOREIGN KEY (Ma_hoadon) REFERENCES HOADON(Ma_hoadon),
	FOREIGN KEY (Ma_sp) REFERENCES SANPHAM(Ma_sp),
	PRIMARY KEY(Ma_hoadon, Ma_sp))


/*
	Viết trigger khi xóa một nhà cung cấp thay vì xóa nhà cung cấp đó thì cập nhật các cột
	tình trạng có liên quan tới nhà cung cấp = 0
*/
CREATE TRIGGER TRIG_1
ON NHACUNGCAP
INSTEAD OF DELETE
AS
BEGIN
	UPDATE NHACUNGCAP SET Tinh_trang = 0 WHERE Ma_ncc = (SELECT Ma_ncc From DELETED)
END
/*
	Viết trigger khi xóa một sản phẩm thay vì xóa sản phẩm đó thì cập nhật các cột
	tình trạng = 0
*/
CREATE TRIGGER TRIG_2
ON SANPHAM
INSTEAD OF DELETE
AS
BEGIN
	UPDATE SANPHAM SET Tinh_trang = 0 WHERE Ma_sp = (SELECT Ma_sp From DELETED)
END
/*
	TRIG 3: Viết trigger khi xóa một nhà vận chuyển thay vì xóa nhà vận chuyển đó thì cập nhật các cột
	tình trạng có liên quan tới nhà vận chuyển = 0
*/
CREATE TRIGGER TRIG_3
ON NHAVANCHUYEN
INSTEAD OF DELETE
AS
BEGIN
	UPDATE NHAVANCHUYEN SET Tinh_trang = 0 WHERE Ma_nvc = (SELECT Ma_nvc From DELETED)
END
/*
	Viết trigger khi xóa nhân viên thay vì xóa nhân viên đó thì cập nhật cột còn làm = 0
*/
CREATE TRIGGER TRIG_4
ON NHANVIEN
INSTEAD OF DELETE
AS
BEGIN
	UPDATE NHANVIEN SET Tinh_trang = 0 WHERE Ma_nv = (SELECT Ma_nv From DELETED)
END
/*
	Viết trigger khi xóa một khách hàng thay vì xóa khách hàng đó thì cập nhật cột tình trạng của 
	bảng hóa đơn = 0, chi tiết hóa đơn = 0
*/
CREATE TRIGGER TRIG_5
ON KHACHHANG
INSTEAD OF DELETE
AS
BEGIN
	UPDATE KHACHHANG SET Tinh_trang = 0 WHERE MA_KHACH = (SELECT Ma_khach From DELETED)
	UPDATE HOADON SET Tinh_trang = 0 WHERE Ma_khach = (SELECT Ma_khach From DELETED)
	DECLARE @mahd int
	SELECT @mahd = Ma_hoadon FROM HOADON, DELETED WHERE HOADON.Ma_khach = DELETED.Ma_Khach
	UPDATE CHITIETHD SET Tinh_trang = 0 WHERE Ma_hoadon IN (@mahd)
END
/*
	Viết trigger khi xóa một hóa đơn thay vì xóa háo đơn đó thì cập nhật cột tình trạng của 
	hóa đơn = 0 và chi tiết hóa đơn = 0
*/
CREATE TRIGGER TRIG_6
ON HOADON
INSTEAD OF DELETE
AS
BEGIN
	DECLARE @mak CHAR(10)
	SELECT @mak = KHACHHANG.Ma_khach FROM KHACHHANG, DELETED 
			WHERE KhachHang.Ma_Khach = DELETED.Ma_Khach
	UPDATE HOADON SET Tinh_trang = 0 WHERE Ma_hoadon = (SELECT Ma_hoadon From DELETED)
	UPDATE CHITIETHD SET Tinh_trang = 0 WHERE Ma_hoadon = (SELECT Ma_hoadon From DELETED)
END
/*
	Viết trigger khi xóa một chi tiết hóa đơn thì cập nhật cột tình trạng = 0
	và số lượng tồn trong kho
*/
CREATE TRIGGER TRIG_7
ON CHITIETHD
INSTEAD OF DELETE
AS
BEGIN
	UPDATE CHITIETHD SET Tinh_trang = 0 WHERE Ma_hoadon = (SELECT Ma_hoadon From DELETED)
	Update SanPham Set So_luongTon = So_luongTon +  (Select So_luongBan From DELETED)
	Where SanPham.Ma_sp = (Select DELETED.Ma_sp From DELETED)
END
/*
	Viết trigger khi thêm mới hóa đơn thì cập nhật tiền ship = 0 nếu địa chỉ ở đống đa còn lại = 30k
	và chỉ có nhân viên có chức vụ là seller mới được tạo hóa đơn
*/
CREATE TRIGGER TRIG_8 -- CHƯA CHẠY
On HoaDon
For Insert, Update
As
Begin
	Declare @ma_nv char(10)
	Select @ma_nv = NhanVien.Ma_nv From NhanVien, INSERTED 
		   Where NhanVien.Ma_nv = INSERTED.Ma_nv AND Chuc_vu = N'Seller'
	IF((Select Ma_nv From INSERTED) IN (@ma_nv))		   
		Update HoaDon Set Phi_ship = 30
		From (Select Ma_HoaDon From Inserted) As I
		Where HoaDon.Ma_hoadon = I.Ma_hoadon and Dia_chinhan != N'Đống Đa'
	Else
		ROLLBACK TRAN
End
/*
	Viết trigger khi thêm mới một chi tiết hóa đơn thì tự động cập nhật số lượng tồn và sản phẩm 
	bán ra phải nhỏ hơn số lượng còn trong kho	
*/
CREATE TRIGGER TRIG_9 -- chạy sau khi thực hiện insert chi tiết hóa đơn
ON CHITIETHD 
FOR INSERT
AS 
BEGIN
	DECLARE @slcon INT;
	DECLARE @slban INT;
	SELECT @slban = So_luongBan FROM INSERTED
	SELECT @slcon = So_luongTon FROM INSERTED, SANPHAM WHERE SANPHAM.Ma_sp = INSERTED.Ma_sp
	IF(@slban<=@slcon)
	BEGIN
		UPDATE SANPHAM SET So_luongTon = So_luongTon - @slban 
		FROM INSERTED, SANPHAM WHERE SANPHAM.Ma_sp = INSERTED.Ma_sp
	END
END

/*
	Viết trigger khi cập nhật bảng chi tiết hóa đơn thì số lượng cập nhật
*/
CREATE TRIGGER TRIG_10
On ChiTietHD 
For Update
As
Begin
	Update SanPham Set So_luongTon = So_luongTon 
				  - (Select So_luongBan From INSERTED Where Ma_sp = INSERTED.Ma_sp)
				  + (Select So_luongBan From DELETED Where Ma_sp = DELETED.Ma_sp)
	Where SanPham.Ma_sp = (Select Ma_sp From DELETED)
End

--Viết hàm trả về tổng tiền của một hóa đơn với mã hóa đơn và tham số đầu vào 
CREATE FUNCTION FUNC_2(@mahd INT)
RETURNS FLOAT
AS
BEGIN
	DECLARE @Tongtien FLOAT
	SELECT @Tongtien =  (Sum(dbo.Func_1(ChiTietHD.Ma_hoadon,Ma_sp)) + Phi_ship)
	FROM ChiTietHD, HoaDon
	WHERE HoaDon.Ma_hoadon = @mahd and HoaDon.Ma_hoadon = ChiTietHD.Ma_hoadon
		  AND ChiTietHD.Tinh_trang = 1 AND HoaDon.Tinh_trang = 1
	GROUP BY ChiTietHD.Ma_hoadon, Phi_ship
	RETURN @Tongtien
END

Select Ma_hoadon,
dbo.Func_2(Ma_hoadon)
As TongTien From HoaDon

/*
	Viết trigger tự động cập nhật thành tiền = FUNC_1() khi thêm mới chi tiết hóa đơn,
	Cập tự động cập nhật tổng tiền = FUNC_2()
*/



--Dữ liệu bảng Nhà cung cấp
Insert into NhaCungCap(Ma_ncc, Ten_ncc, SDT_ncc, Diachi_ncc)
Values('NCC01', N'Nike', '096 5269082', N'Ninh Bình'),
	  ('NCC02', N'Adidas', '038 6653766', N'Thái Bình'),
	  ('NCC03', N'Converse', '039 7433097', N'Hà Nội'),
	  ('NCC04', N'Vans', '033 3333147', N'Nghệ An'),
	  ('NCC05', N'MLB', '038 7383884', N'Hà Nội')
--Dữ liệu bảng
INSERT INTO SANPHAM(Ma_sp, Ten_sp, Mo_ta, Gia_nhap, Gia_ban, So_luongTon, Ma_ncc)
Values('SP001', 'Nike Air Force 1', 'sanpham1.jpg', 1050, 1110, 19, 'NCC01'),
	  ('SP002', 'Nike Air Jordan 1', 'sanpham2.jpg', 2100, 2200, 14, 'NCC01'),
	  ('SP003', 'Nike Air Jordan 4', 'sanpham3.jpg', 2500, 2700, 20, 'NCC01'),
	  ('SP004', 'Nike Air Max97', 'sanpham4.jpg', 1400, 1500, 15, 'NCC01'),
	  ('SP005', 'Adidas Supper Star', 'sanpham5.jpg', 900, 1050, 10, 'NCC02'),
	  ('SP006', 'Addidas EQT', 'sanpham6.jpg', 1200, 1280, 9, 'NCC02'),
	  ('SP007', 'Yezzy 350', 'sanpham7.jpg', 2150, 2300, 30, 'NCC02'),
	  ('SP008', 'Convert 1970s', 'sanpham8.jpg', 1520, 1650, 12, 'NCC03'),
	  ('SP009', 'Convert Chuck Taylor', 'sanpham9.jpg', 1350, 1500, 15, 'NCC03'),
	  ('SP010', 'Convert Fear Of Good', 'sanpham10.jpg', 3500, 3750,20, 'NCC03'),
	  ('SP011', 'Vans Old Skool', 'sanpham11.jpg', 1350, 1420, 30, 'NCC04'),
	  ('SP012', 'Vans Style 36', 'sanpham12.jpg', 1700, 1800,25, 'NCC04'),
	  ('SP013', 'Vans Vault', 'sanpham13.jpg', 1950, 2050, 42, 'NCC04'),
	  ('SP014', 'MLB NY', 'sanpham14.jpg', 2750, 2900,30, 'NCC05'),
	  ('SP015', 'MLC Play Ball', 'sanpham15.jpg', 1480, 1600, 9, 'NCC05')

--Bảng nhân viên
Insert into NhanVien(Ma_nv, Ten_nv, Gioi_tinh, Ngay_sinh, Chuc_vu, Mo_ta, Dia_chi, So_Dt)
Values('NV01', N'Trịnh Hoàng Long', 1, '10-29-2001', N'Quản Lý', 'nhanvien1.jpg',N'Chương Mỹ', '011 111111'),
	  ('NV02', N'Nguyễn Minh Đức', 1, '09-20-2001', N'Bảo Vệ','nhanvien2.jpg', N'Đống Đa', '011 2222222'),
	  ('NV03', N'Nguyễn Văn Tân', 1, '03-02-2001', N'Bảo Vệ', 'nhanvien3.jpg',N'Đống Đa', '011 3333333'),
	  ('NV04', N'Nguyễn Thị Thu', 0, '10-10-2002', N'Seller', 'nhanvien4.jpg',N'Đống Đa', '011 4444444'),
	  ('NV05', N'Lê Thị Lương', 0, '09-09-2001', N'Seller', 'nhanvien5.jpg', N'Đống Đa', '011 5555555'),
	  ('NV06', N'Bùi Thị Diễm', 0, '08-08-2002', N'Seller', 'nhanvien6.jpg',N'Đống Đa', '011 6666666'),
	  ('NV07', N'Vũ Thị Hồng Hạnh', 0, '07-07-2001', N'Seller', 'nhanvien7.jpg', N'Đống Đa', '011 7777777')
SELECT * FROM NHANVIEN
--Dữ liệu bảng Lương
Insert into Luong
Values('NV01', 29, 300), 
	  ('NV02', 19, 200),
	  ('NV03', 11, 180),
	  ('NV04', 15, 200),
	  ('NV05', 15, 220),
	  ('NV06', 12, 190),
	  ('NV07', 18, 200)
--Dữ liệu bảng khách hàng
Insert into KhachHang(Ma_khach, Ten_khach, Gioi_tinh, So_dienThoai)
Values('KH001', N'Hồ Hồng Quân',1,'022 11111111'),
	  ('KH002', N'Nguyễn Thị Thủy',0,'022 2222222'),
	  ('KH003', N'Nguyễn Minh Vương',1,'022 3333333'),
	  ('KH004', N'Hồ Tuấn Anh',1,'022 4444444'),
	  ('KH005', N'Hoàng Thị Hương',0,'022 5555555'),
	  ('KH006', N'Hoàng Thị Thu Trang',0,'022 6666666'),
	  ('KH007', N'Vương Văn Doanh',1,'022 7777777'),
	  ('KH008', N'Nguyễn Duy Lịch',1,'022 8888888'),
	  ('KH009', N'Vũ Huyền Trang',0,'022 9999999'),
	  ('KH010', N'Tạ Bích Loan',0,'022 0000000')

--Dữ liệu bảng NhaVanChuyen
Insert into NHAVANCHUYEN(Ma_nvc, Ten_nvc, SDT_nvc)
Values('NVC01', N'Giao Hàng Nhanh','033 1111111'),
	  ('NVC02', N'Giao Hàng Tiết Kiệm','033 2222222'),
	  ('NVC03', N'Viettel Post','033 3333333')

--Dữ liệu bảng HoaDon
Insert into HoaDon(Ngay_hoadon, Ma_nv, Ma_khach, Ma_nvc, Dia_chinhan, Phi_ship)
Values('09-29-2021', 'NV04', 'KH001', 'NVC01', N'Đống Đa', ''),
	  ('09-09-2021', 'NV05', 'KH002', 'NVC02', N'Chương Mỹ', ''),
	  ('09-30-2021', 'NV06', 'KH003', 'NVC01', N'Long Biên', ''),
	  ('09-30-2021', 'NV07', 'KH004', 'NVC01', N'Đống Đa', ''),
	  ('09-30-2021', 'NV06', 'KH005', 'NVC03', N'Nghệ An', ''),
	  ('10-01-2021', 'NV07', 'KH006', 'NVC01', N'Thái Bình', ''),
	  ('10-01-2021', 'NV06', 'KH007', 'NVC03', N'Ninh Bình', ''),
	  ('10-01-2021', 'NV07', 'KH008', 'NVC01', N'Hà Nam', ''),
	  ('10-01-2021', 'NV06', 'KH009', 'NVC01', N'Đống Đa', ''),
	  ('10-01-2021', 'NV07', 'KH010', 'NVC02', N'Nha Trang', '')
SELECT * FROM HOADON
UPDATE HOADON SET Phi_ship = 30 WHERE Dia_chinhan != N'Đống Đa'
--Xóa TRIGGER_8 rồi insert sau đó tạo lại
DBCC CHECKIDENT ('HoaDon', RESEED, 0)
--Dữ liệu bảng chi tiết hóa đơn
SELECT * FROM CHITIETHD
Insert into ChiTietHD(Ma_hoadon, Ma_sp, So_luongBan)
Values(1, 'SP001', 1),
	  (1, 'SP002', 1),
	  (2, 'SP002', 1),
	  (3, 'SP008', 1),
	  (3, 'SP003', 1),
	  (4, 'SP002', 2),
	  (5, 'SP014', 1),
	  (6, 'SP004', 1),
	  (6, 'SP013', 1),
	  (7, 'SP006', 1),
	  (8, 'SP015', 2),
	  (9, 'SP001', 3),
	  (9, 'SP004', 3),
	  (10, 'SP006', 1),
	  (10, 'SP010', 1)

	  /*HÀM*/
	  
/*
		Viết hàm trả về tiền của một sản phẩm trong đơn hàng có mã 
		hóa đơn và mã sản phẩm được truyền vào qua tham số
*/
CREATE FUNCTION FUNC_1(@mahd INT, @ma_sp CHAR(10))
RETURNS FLOAT
AS
BEGIN
	DECLARE @ThanhTien FLOAT
	SELECT @ThanhTien = (SELECT (So_luongBan * Gia_ban) FROM ChiTietHD, SanPham
	WHERE ChiTietHD.Ma_sp= SanPham.Ma_sp AND Ma_hoadon = @mahd and ChiTietHD.Ma_sp = @ma_sp
			AND ChiTietHD.Tinh_trang = 1 AND SanPham.Tinh_trang = 1)
	RETURN @ThanhTien
End

Select Ma_hoadon, dbo.Func_1(Ma_hoadon,Ma_sp) As ThanhTien FROM CHITIETHD
/*
	Tạo thủ tục lưu trữ thông tin của mỗi mặt hàng với tên sản phẩm được truyền vào
*/
Go
CREATE PROC PROC_1
@tensp NVARCHAR(100)
AS 
BEGIN
	DECLARE @masp CHAR(10)
	SELECT @masp = Ma_sp FROM SanPham WHERE Ten_sp = @tensp 
	SELECT SanPham.Ma_sp, Ten_sp, NhaCungCap.Ma_ncc,Ten_ncc, SUM(So_luongBan) AS Tong_slb,
		   SUM(Gia_nhap*So_luongBan) AS Tong_tienNhap, SUM(So_luongBan*Gia_ban) AS Tong_tienBan,
		   ((SUM(So_luongBan*Gia_ban))-(SUM(Gia_nhap*So_luongBan))) As Tong_doanhThu 
	FROM ChiTietHD, SanPham, NhaCungCap
	WHERE ChiTietHD.Ma_sp = SanPham.Ma_sp and NhaCungCap.Ma_ncc = SanPham.Ma_ncc
		  and SanPham.Ma_sp = @masp
	GROUP BY SanPham.Ma_Sp, Ten_Sp,  NhaCungCap.Ma_ncc,Ten_ncc
END

EXECUTE PROC_1 N'Nike Air Force 1'
/*
	Tạo thủ tục lưu trữ thông tin bảng lương tháng 9 của nhân viên
*/
SELECT * FROM dbo.Func_3
GO
CREATE PROCEDURE PROC_2 -- CHẠY HÀM 3 TRƯỚC
AS
BEGIN
	Select NhanVien.Ma_nv, Ten_nv, Chuc_vu, Muc_luong, So_ngayLam,
			ISNULL(dbo.Func_3(NhanVien.Ma_nv,  '09-01-2021'), 0) As SoHoaDon,
			((Muc_luong*So_ngayLam) + (ISNULL(dbo.Func_3(NhanVien.Ma_nv,  '09-01-2021'), 0)*2)) As TongLuong
	From NhanVien, Luong
	Where NhanVien.Ma_nv = Luong.Ma_nv
	Group by NhanVien.Ma_nv, Ten_nv, Chuc_vu, Muc_luong, So_ngayLam
END

EXECUTE PROC_2
/*
	Tạo thủ tục lưu trữ thông tin những khách bom hàng
*/
SELECT * FROM HOADON
SELECT * FROM KHACHHANG
SELECT * FROM CHITIETHD
GO
CREATE PROC PROC_3
AS
BEGIN
	SELECT HoaDon.Ma_hoadon, Ngay_hoadon, Ten_sp, KhachHang.Ma_khach,
		   Ten_Khach, So_dienThoai, Dia_chinhan, Phi_ship
	From HoaDon, KhachHang, ChiTietHD, SanPham
	Where HoaDon.Ma_hoadon = ChiTietHD.Ma_hoadon AND SanPham.Ma_sp = ChiTietHD.Ma_sp
		  AND KhachHang.Ma_khach = HoaDon.Ma_khach AND KhachHang.Tinh_trang = 0
END
DELETE FROM KHACHHANG WHERE Ma_khach = 'KH004'
EXECUTE PROC_3
CREATE vIEW VIEW_3(Ma_hoadon, Ngay_hoadon, Ten_sp, Ma_Khach, Ten_Khach, So_dienthoai, Dia_chinhan, Phi_ship)
AS
SELECT HoaDon.Ma_hoadon, Ngay_hoadon, Ten_sp, KhachHang.Ma_khach, Ten_Khach, So_dienThoai, Dia_chinhan, Phi_ship
	From HoaDon, KhachHang, ChiTietHD, SanPham
	Where HoaDon.Ma_hoadon = ChiTietHD.Ma_hoadon AND SanPham.Ma_sp = ChiTietHD.Ma_sp
		  AND KhachHang.Ma_khach = HoaDon.Ma_khach AND KhachHang.Tinh_trang = 0

		  SELECT * FROM VIEW_3
--SỬ DỤNG HÀM
/*
	Viết hàm trả về tiền của một sản phẩm trong đơn hàng có mã hóa đơn và mã sản phẩm được truyền vào
	ThanhTien = (So_luongBan * GiaBan) Select * From ChiTietHD
*/
ALTER FUNCTION FUNC_1(@mahd INT, @ma_sp CHAR(10))
RETURNS FLOAT
AS
BEGIN
	DECLARE @ThanhTien FLOAT
	SELECT @ThanhTien = (SELECT (So_luongBan * Gia_ban) FROM ChiTietHD, SanPham
	WHERE ChiTietHD.Ma_sp= SanPham.Ma_sp AND Ma_hoadon = @mahd and ChiTietHD.Ma_sp = @ma_sp
			AND ChiTietHD.Tinh_trang = 1 AND SanPham.Tinh_trang = 1)
	RETURN @ThanhTien
End

Select Ma_hoadon, dbo.Func_1(Ma_hoadon,Ma_sp) As ThanhTien FROM CHITIETHD

--Viết hàm trả về tổng tiền của một hóa đơn với mã hóa đơn và tham số đầu vào 
ALTER FUNCTION FUNC_2(@mahd INT)
RETURNS FLOAT
AS
BEGIN
	DECLARE @Tongtien FLOAT
	SELECT @Tongtien =  (Sum(dbo.Func_1(ChiTietHD.Ma_hoadon,Ma_sp)) + Phi_ship)
	FROM ChiTietHD, HoaDon
	WHERE HoaDon.Ma_hoadon = @mahd and HoaDon.Ma_hoadon = ChiTietHD.Ma_hoadon
		  AND ChiTietHD.Tinh_trang = 1 AND HoaDon.Tinh_trang = 1
	GROUP BY ChiTietHD.Ma_hoadon, Phi_ship
	RETURN @Tongtien
END

Select Ma_hoadon, dbo.Func_2(Ma_hoadon) As TongTien From HoaDon

--Viết view trả về danh sách các đơn hàng của nhà cung cấp nào đó với mã cc được truyền vào
--Viết thủ tục thống kê doanh thu của mỗi sản phẩm

/*
	Tạo view để thống kê số hóa đơn mà nhân viên bán được
*/
CREATE VIEW View_1
As
Select HoaDon.Ma_nv, Ten_nv, Ngay_hoadon, Count(Ma_hoadon) as SoHD 
From NhanVien, HoaDon
Where NhanVien.Ma_nv = HoaDon.Ma_nv AND HoaDon.Tinh_trang = 1
Group By HoaDon.Ma_nv, Ten_nv, Ngay_hoadon

Select * From View_1

/*
	Tạo view thống kê khách hàng đã  trả cho 
	sản phẩm gì và số tiền phải trả cho sản phẩm đó
*/
CREATE VIEW VIEW_2(MaKhach, TenKhach,GioiTinh, SoLuongMua, TongTien)
AS
	SELECT KhachHang.Ma_Khach, Ten_khach,
		   CASE Gioi_tinh WHEN 0 THEN N'Nữ' WHEN 1 THEN N'Nam' END,
		   SUM(So_luongBan),
		   SUM(dbo.Func_1(HoaDon.Ma_hoadon, ChiTietHD.Ma_sp))
	FROM KhachHang, HoaDon, ChiTietHD
	WHERE KhachHang.Ma_Khach = HoaDon.Ma_Khach AND ChiTietHD.Ma_hoadon = HoaDon.Ma_hoadon
		  AND KhachHang.Tinh_trang = 1
	GROUP BY KhachHang.Ma_khach, Ten_khach, Gioi_tinh
SELECT * FROM VIEW_2
/*Sử dụng view 2*/
--Tạo thủ tục lưu trữ thông tin khách hàng có số tiền phải trả mua cho mua hàng nhiều nhất
CREATE PROC PROC_4
AS
BEGIN
	SELECT * FROM VIEW_2
	WHERE TongTien = (SELECT MAX(TongTien) FROM VIEW_2)
END
SELECT * FROM VIEW_2
EXECUTE PROC_4

/*TẠO THỦ TỤC LƯU TRỮ THÔNG TIN HÓA ĐƠN GIỮA 2 NGÀY ĐƯỢC NHẬP VÀO*/
CREATE PROC PROC_5
@day1 DATE,
@day2 DATE
AS
BEGIN
	SELECT HOADON.Ma_hoadon,Ngay_hoadon, Ma_nv, KHACHHANG.Ma_Khach, Ma_nvc, Ma_sp
	FROM HOADON, CHITIETHD, KHACHHANG
	WHERE HOADON.Ma_hoadon = CHITIETHD.Ma_hoadon AND HoaDon.Ma_khach = KhachHang.Ma_khach
		  AND KHACHHANG.Tinh_trang = 1 AND HOADON.Tinh_trang = 1 
		  AND DAY(Ngay_hoadon) BETWEEN DAY(@day1) AND DAY(@day2)
END

EXECUTE PROC_5 @day1 = '10-01-2021', @day2 = '10-03-2021'
SELECT * FROM HOADON

--Viết function trả về số hóa đơn tương ứng từng tháng với mã nv, tháng được truyền vào 
CREATE FUNCTION FUNC_3(@manv char(10), @thang date) -- CHẠY VIEW 1 TRƯỚC
Returns INT
As
Begin
	Declare @sohd int
	Select @sohd = SUM(SoHD) From View_1 
	Where Ma_nv = @manV AND Month(Ngay_hoadon) = Month(@thang) and Year(Ngay_hoadon) = Year(Ngay_hoadon)
	Group by Ma_nv
	Return @sohd
End
Select Ma_nv, ISNULL(dbo.Func_3(Ma_nv,  '09-01-2021'), 0) As SoHoaDon From NhanVien --Cho những giá trị null == 0
--Sử dụng để thống kê số hàng bán được với tháng được nhập vào
--Những nhân viên, khách hàng đã bán, mua sản phẩm với tên sản phẩm truyền vào

--Tạo thủ tục lưu trữ thông tin
	--khách đó đã mua hàng ở cửa hàng bn lần và sản phẩm đó là bn lần
--Tạo function thống kê khách hàng đã đến cửa hàng mua 
--những sản phẩm gì và số tiền phải trả cho sản phẩm đó và mã khách là tham số đầu vào
Create Function Func_5(@mak char(10)) -- viết thành view
Returns @table TABLE(MaKhach char(10), HoTen nvarchar(30), GioiTinh nvarchar(10), MaHoaDon int,
					 MaSanPham char(10), TenSanPham nvarchar(50), SoLuong int, NgayMua Date,
					 DiaChiNhan nvarchar(100), ThanhTien float)
As
Begin
	Insert into @table
	Select KhachHang.Ma_Khach, Ten_khach,
		   CASE Gioi_tinh WHEN 0 THEN N'Nữ' WHEN 1 THEN N'Nam' END,
		   HoaDon.Ma_hoadon, SanPham.Ma_sp, Ten_sp,So_luongBan, Ngay_hoadon, Dia_chinhan,
		   dbo.Func_1(HoaDon.Ma_hoadon, SanPham.Ma_sp)
	From KhachHang, HoaDon, SanPham, ChiTietHD
	Where KhachHang.Ma_Khach = HoaDon.Ma_Khach AND KhachHang.Ma_Khach = @mak
		  AND SanPham.Ma_sp = ChitietHD.Ma_sp AND ChiTietHD.Ma_hoadon = HoaDon.Ma_hoadon
	Return
End

Select * FROM dbo.Func_5('KH001')
--Viết trigger khi xóa sản phẩm thì tự động cập nhật, 

/*PHÂN QUYỀN*/
/*Tạo role*/
sp_addrole'nhanvien'

/*Cấp quyền cho role*/
grant insert, delete, update ON HOADON to nhanvien
grant insert, delete, update ON CHITIETHD to nhanvien
grant select on SANPHAM to nhanvien

/*Tạo 2 user*/
sp_addlogin 'duc', '12345'
sp_addlogin 'long', '123'

/*Map user*/
USE BTL_CuaHangGiay
exec sp_grantdbaccess 'duc', 'DUC'
exec sp_grantdbaccess 'long', 'LONG'

/*Gắn user DUC, LONG vào role*/
sp_addrolemember 'nhanvien', 'DUC'
sp_addrolemember 'nhanvien', 'LONG'