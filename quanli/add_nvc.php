<?php
    include('header.php');
?>
<!-- CODE THÊM -->
    <main>
        <form action="" method="POST" class="register" enctype="multipart/form-data">
            <?php
                //CODE PHP
                if(isset($_POST['submit'])){
                    $ma_nvc = $_POST['ma_ncc'];
                    $ten_nvc = $_POST['ten_ncc'];
                    $sdt_nvc = $_POST['phone'];
                    
                    $sql = "INSERT INTO NHAVANCHUYEN(Ma_nvc, Ten_nvc, SDT_nvc) 
                    VALUES('$ma_nvc', N'$ten_nvc', '$sdt_nvc')";
                    $res =  sqlsrv_query($conn, $sql);
                    if($res > 0)
                    {
                        header("Location:nhavanchuyen.php");
                    }
                    else
                    {
                        header("Location:add_nvc.php");   
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã nhà vận chuyển</span>
                <input type="text" class="form-control" name="ma_ncc">
            </div>
            <div class="form-group">
                <span>Tên nhà vận chuyển</span>
                <input type="text" class="form-control" name="ten_ncc">               
            </div>
            <div class="form-group">
                <span>Số điện thoại</span>
                <input type="phone" class="form-control" name="phone"> 
            </div>
            <input type="submit" name="submit" value="Thêm nhà vận chuyển" class="btn btn-add btn-add-connect">
            <a href="nhavanchuyen.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>