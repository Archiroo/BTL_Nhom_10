<?php
    include('header.php');
    if(isset($_GET['id_sp'])){
        $id = $_GET['id_sp'];
    }
?>
<!-- CODE THÊM -->
    <main>
            <?php
                $sql = "SELECT * FROM SANPHAM WHERE Ma_sp = '$id'";
                $res =  sqlsrv_query($conn, $sql);
                if($res==TRUE)
                {
                    $row = sqlsrv_fetch_array($res);
                    $ten_sp = $row['Ten_sp'];
                    $anh = $row['Mo_ta'];
                    $gia_nhap = $row['Gia_nhap'];
                    $gia_ba = $row['Gia_ban'];
                    
                    $sl = $row['So_luongTon'];
                    $ma_ncc = $row['Ma_ncc'];
                }
            ?>
        <form action="" method="POST" class="register">
            <?php
                // CODE UPDATE
                if(isset($_POST['submit'])){
                    $ten1 = $_POST['name'];
                    $price1 = $_POST['price1'];
                    $price2 = $_POST['price2'];
                    $img1 = $_POST['image'];
                    if($ten1!=""){
                        $sql2 = "UPDATE SANPHAM SET Ten_sp = N'$ten1', Gia_nhap = '$price1', Gia_ban = '$price2', 
                                So_luongTon = '$sl', Mo_ta = '$img1'
                                    WHERE Ma_sp = '$id'";
                        $res2 =  sqlsrv_query($conn, $sql2);
                        if($res2 == TRUE)
                        {
                            header("Location:sanpham.php");
                        }
                        else
                        {
                            header("Location:update_sp.php");
                        }
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã sản phẩm</span>
                <input type="text" class="form-control read" readonly value="<?php echo $ma_ncc;?>">
            </div>
            <div class="form-group">
                <span>Mã nhà cung cấp</span>
                <input type="text" class="form-control read" readonly value="<?php echo $id;?>">
            </div>
            <div class="form-group">
                <span>Tên sản phẩm</span>
                <input type="text" class="form-control" name="name" value="<?php echo $ten_sp; ?>">              
            </div>
            <div class="form-group">
                <span>Giá nhập</span>
                <input type="text" class="form-control" name="price1" value="<?php echo $gia_nhap; ?>">
            </div>
            <div class="form-group">
                <span>Giá bán</span>
                <input type="text" class="form-control" name="price2" value="<?php echo $gia_ba; ?>">
            </div>
            <div class="gender">
                <span>Ảnh</span>
                <br>
                <input type="file" name="image" class="file" value="<?php echo $anh; ?>">
            </div>
            <input type="submit" name="submit" value="Cập nhật" class="btn btn-add btn-add-connect">
            <a href="sanpham.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>