<?php
include('header.php');
?>
<main>
    <form action="" method="POST" class="register" enctype="multipart/form-data">
        <div class="form-group  first-span">
            <span>Mã khách hàng</span>
            <input type="text" class="form-control" name="id">
        </div>
        <div class="form-group">
            <span>Tên khách hàng</span>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="gender">
            <span>Giới tính</span>
            <br>
            <div>
                <input type="radio" name="gender" value="1"><span>Nam</span>
                <input type="radio" name="gender" value="0"><span>Nữ</span>
            </div>
        </div>
        
        <div class="form-group">
            <span>Số điện thoại</span>
            <input type="text" class="form-control" name="phone">
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Thêm khách hàng</button>
        </div>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];

            $sql = "INSERT into KHACHHANG(Ma_khach,Ten_khach,Gioi_tinh,So_dienThoai)
                    values ('$id',N'$name',N'$gender','$phone')";
            $res = sqlsrv_query($conn, $sql);
            if($res > 1){
                header('location:customer.php');
            }
            else{
                echo 'fail';
            }
        }
    ?>
<?php
    include('footer.php');
?>