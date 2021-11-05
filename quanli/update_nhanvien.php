<?php
    include('header.php');
    if(isset($_GET['id_nv'])){
        $id = $_GET['id_nv'];
    }
?>
<!-- CODE THÊM -->
    <main>
            <?php
                $sql = "SELECT * FROM NHANVIEN WHERE Tinh_trang = 1 AND Ma_nv = '$id'";
                $res =  sqlsrv_query($conn, $sql);
                if($res==TRUE)
                {
                    $row = sqlsrv_fetch_array($res);
                    $ten_nv = $row['Ten_nv'];
                    $gioitinh = $row['Gioi_tinh'];
                    $chuc_vu = $row['Chuc_vu'];
                    $sdt = $row['So_dt'];
                    $anh = $row['Mo_ta'];
                }
            ?>
        <form action="" method="POST" class="register">
            <?php
                // CODE UPDATE
                if(isset($_POST['submit'])){
                    $ten1 = $_POST['name'];
                    $chucvu1 = $_POST['cv'];
                    $sdt1 = $_POST['phone'];
                    $img1 = $_POST['image'];
                    if($ten1!=""){
                        $sql2 = "UPDATE NHANVIEN SET Ten_nv = N'$ten1', Chuc_vu = N'$chucvu1', So_dt = '$sdt1', Mo_ta = '$img1'
                                    WHERE Ma_nv = '$id'";
                        $res2 =  sqlsrv_query($conn, $sql2);
                        if($res2 == TRUE)
                        {
                            header("Location:nhanvien.php");
                        }
                        else
                        {
                            header("Location:update_nhanvien.php");
                        }
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã nhân viên</span>
                <input type="text" class="form-control read" readonly value="<?php echo $id;?>">
            </div>
            <div class="form-group">
                <span>Tên nhân viên</span>
                <input type="text" class="form-control" name="name" value="<?php echo $ten_nv; ?>">              
            </div>
            <div class="form-group">
                <span>Chức vụ</span>
                <br>
                <select name="cv" id="">
                    <option value="Bảo vệ">Bảo vệ</option>
                    <option value="Seller">Seller</option>
                </select>
            </div>
            <div class="form-group">
                <span>Số điện thoại</span>
                <input type="phone" class="form-control" name="phone" value="<?php echo $sdt; ?>">
            </div>
            <div class="gender">
                <span>Image</span>
                <br>
                <input type="file" name="image" class="file" value="<?php echo $anh; ?>">
            </div>
            <input type="submit" name="submit" value="Thêm nhân viên" class="btn btn-add btn-add-connect">
            <a href="nhanvien.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>