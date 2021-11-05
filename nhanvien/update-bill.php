<?php
include('header.php');
?>
<main>
    <?php
    if (isset($_GET['Ma_hoadon'])) {
        $id = $_GET['Ma_hoadon'];
        $sql4 = "SELECT * from HOADON where Ma_hoadon = '$id'";
        $res4 = sqlsrv_query($conn, $sql4);
        if ($res4 == true) {
            $row4 = sqlsrv_fetch_array($res4);
            $ngay = $row4['Ngay_hoadon'];
            $diachi = $row4['Dia_chinhan'];
        }
    }
    ?>
    <form action="" method="POST" class="register" enctype="multipart/form-data">
        <div class="form-group">
            <span>Ngày hóa đơn</span>
            <input type="date" class="form-control" name="date">
        </div>
        <div class="form-group  first-span">
            <span>Tên nhân viên</span>
            <br>
            <select name="nhanvien" id="nhanvien">
                <?php
                $sql1 = "SELECT * from NHANVIEN";
                $res1 = sqlsrv_query($conn, $sql1);
                if ($res1 == true) {
                    while ($row1 = sqlsrv_fetch_array($res1)) {
                        $manv = $row1['Ma_nv'];
                        $tennv = $row1['Ten_nv'];
                ?>
                        <option value="<?php echo $manv; ?>"><?php echo $tennv; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <span>Mã khách</span>
            <br>
            <select name="khach" id="khach" style="display:block;">
                <?php
                $sql2 = "SELECT * from KHACHHANG";
                $res2 = sqlsrv_query($conn, $sql2);
                if ($res2 == true) {
                    while ($row2 = sqlsrv_fetch_array($res2)) {
                        $mak = $row2['Ma_khach'];
                ?>
                        <option value="<?php echo $mak; ?>"><?php echo $mak; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group  first-span">
            <span>Tên nhà vận chuyển</span>
            <br>
            <select name="nvc" id="nvc">
                <?php
                $sql3 = "SELECT * from NHAVANCHUYEN";
                $res3 = sqlsrv_query($conn, $sql3);
                if ($res3 == true) {
                    while ($row3 = sqlsrv_fetch_array($res3)) {
                        $manvc = $row3['Ma_nvc'];
                        $tennvc = $row3['Ten_nvc'];
                ?>
                        <option value="<?php echo $manvc; ?>"><?php echo $tennvc; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <span>Địa chỉ nhận</span>
            <input type="text" class="form-control" name="place" value="<?php echo $diachi ?>">
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Cập nhật</button>
        </div>
    </form>
    <?php
    if (isset($_POST['submit'])){
        $ngayhd = $_POST['date'];
        $manvien = $_POST['nhanvien'];
        $makhach = $_POST['khach'];
        $manvchuyen = $_POST['nvc'];
        $diachi = $_POST['place'];

        $date= strtotime($ngayhd);
        $format_date = date('Y-m-d', $date);

        $sql = "UPDATE HOADON set
            Ngay_hoadon = '$format_date',
            Ma_nv = '$manvien',
            Ma_khach = '$makhach',
            Ma_nvc = '$manvchuyen',
            Dia_chinhan = N'$diachi'
            where Ma_hoadon = '$id'
        ";
        $res = sqlsrv_query($conn, $sql);
        
        if($res == true){
            echo 'success';
        }
        else{
            echo 'fail';
        }
    }
    ?>
    <?php
    include('footer.php');
    ?>