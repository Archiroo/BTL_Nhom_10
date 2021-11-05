<?php
    include('header.php');
    if(isset($_GET['id_ncc'])){
        $id = $_GET['id_ncc'];
    }
?>
<!-- CODE THÊM -->
    <main>
        <?php
            $sql = "SELECT * FROM NHACUNGCAP WHERE Ma_ncc = '$id'";
            $res =  sqlsrv_query($conn, $sql);
            if($res==TRUE)
            {
                $row = sqlsrv_fetch_array($res);
                $ten_ncc = $row['Ten_ncc'];
                $std = $row['SDT_ncc'];
                $diachi = $row['Diachi_ncc'];
            }
        ?>
        <form action="" method="POST" class="register">
            <?php
                // CODE UPDATE
                if(isset($_POST['submit'])){
                    $ten1 = $_POST['name'];
                    $phone1 = $_POST['phone'];
                    $address = $_POST['address'];
                    if($ten1!=""){
                        $sql2 = "UPDATE NHACUNGCAP SET Ten_ncc = N'$ten1', SDT_ncc = '$phone1',Diachi_ncc = N'$address'
                                    WHERE Ma_ncc = '$id'";
                        $res2 =  sqlsrv_query($conn, $sql2);
                        if($res2 == TRUE)
                        {
                            header("Location:nhacungcap.php");
                        }
                        else
                        {
                            header("Location:nhacungcap.php");
                        }
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã nhà cung cấp</span>
                <input type="text" class="form-control read" readonly value="<?php echo $id;?>">
            </div>
            <div class="form-group">
                <span>Tên nhà cung cấp</span>
                <input type="text" class="form-control" name="name" value="<?php echo $ten_ncc;?>">              
            </div>
            <div class="form-group">
                <span>Số điện thoại</span>
                <input type="phone" class="form-control" name="phone" value="<?php echo $std?>">
            </div>
            <div class="form-group">
                <span>Địa chỉ</span>
                <input type="text" class="form-control" name="address" value="<?php echo $diachi; ?>">
            </div>
            
            <input type="submit" name="submit" value="Cập nhật nhà cung cấp" class="btn btn-add btn-add-connect">
            <a href="nhanvien.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>