<?php
include('header.php');
?>
<main>
    <form action="" method="POST" class="register">
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
            <input type="text" class="form-control" name="place">
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Thêm hóa đơn</button>
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

        $sql = "INSERT into HOADON (Ngay_hoadon,Ma_nv,Ma_khach,Ma_nvc,Dia_chinhan)
        values ('$format_date','$manvien','$makhach','$manvchuyen',N'$diachi')";
        $res = sqlsrv_query($conn, $sql);
        
        if($res==true){
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