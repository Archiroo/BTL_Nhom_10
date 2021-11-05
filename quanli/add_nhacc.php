<?php
    include('header.php');
?>
<!-- CODE THÊM -->
    <main>
        <form action="" method="POST" class="register" enctype="multipart/form-data">
            <?php
                //CODE PHP
                if(isset($_POST['submit'])){
                    $ma_ncc = $_POST['ma_ncc'];
                    $ten_ncc = $_POST['ten_ncc'];
                    $sdt_ncc = $_POST['phone'];
                    $diachi_ncc = $_POST['address'];
                    
                    $sql = "INSERT INTO NHACUNGCAP(Ma_ncc, Ten_ncc, SDT_ncc, Diachi_ncc) 
                    VALUES('$ma_ncc', N'$ten_ncc', '$sdt_ncc',N'$diachi_ncc')";
                    $res =  sqlsrv_query($conn, $sql);
                    if($res > 0)
                    {
                        header("Location:nhacungcap.php");
                    }
                    else
                    {
                        header("Location:add_nhacc.php");   
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã nhân nhà cung cấp</span>
                <input type="text" class="form-control" name="ma_ncc">
            </div>
            <div class="form-group">
                <span>Tên nhà cung cấp</span>
                <input type="text" class="form-control" name="ten_ncc">               
            </div>
            <div class="form-group">
                <span>Số điện thoại</span>
                <input type="phone" class="form-control" name="phone"> 
            </div>
            <div class="form-group">
                <span>Địa chỉ</span>
                <input type="text" class="form-control" name="address"> 
            </div>
            <input type="submit" name="submit" value="Thêm nhà cung cấp" class="btn btn-add btn-add-connect">
            <a href="nhacungcap.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>