<?php
include('header.php');
?>
<main>
    <?php
    if (isset($_GET['Ma_khach'])) {
        $maK = $_GET['Ma_khach'];
        $sql = "SELECT * from KHACHHANG where Ma_khach='$maK'";
        $res = sqlsrv_query($conn, $sql);
        if ($res == true) {
            $row = sqlsrv_fetch_array($res);
            $tenK = $row['Ten_khach'];
            $gioitinh = $row['Gioi_tinh'];
            $sdt = $row['So_dienThoai'];
        }
    }
    ?>
    <form action="" method="POST" class="register" enctype="multipart/form-data">
        <div class="form-group  first-span">
            <span>Mã khách hàng</span>
            <input type="text" class="form-control" name="id" value="<?php echo $maK; ?>">
        </div>
        <div class="form-group">
            <span>Tên khách hàng</span>
            <input type="text" class="form-control" name="name" value="<?php echo $tenK; ?>">
        </div>
        <div class="gender">
            <span>Giới tính</span>
            <br>
            <div>
                <input <?php if($gioitinh==1){echo "checked";}?> type="radio" name="gender" value="1"><span>Nam</span>
                <input <?php if($gioitinh==0){echo "checked";}?> type="radio" name="gender" value="0"><span>Nữ</span>
            </div>
        </div>

        <div class="form-group">
            <span>Số điện thoại</span>
            <input type="text" class="form-control" name="phone" value="<?php echo $sdt; ?>">
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Cập nhật</button>
        </div>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];

            $sql1 = "UPDATE KHACHHANG set
                Ma_khach = '$id',
                Ten_khach = N'$name',
                Gioi_tinh = N'$gender',
                So_dienThoai = '$phone'
                where Ma_khach = '$id'
            ";
            $res1 = sqlsrv_query($conn, $sql1);{
                if($res1 == true){
                    header('location:customer.php');
                }
            }
        }
    ?>
<?php
    include('footer.php');
?>