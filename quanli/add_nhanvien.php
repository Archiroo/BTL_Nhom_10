<?php
    include('header.php');
?>
<!-- CODE THÊM -->
    <main>
        <form action="" method="POST" class="register" enctype="multipart/form-data">
            <?php
                // CODE PHP
                if(isset($_POST['submit'])){
                    $id_nv = $_POST['ma_nv'];
                    $ten_nv = $_POST['ten_nv'];
                    $gioitinh = $_POST['gender'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];
                    $ngay_sinh = $_POST['birthday'];
                    $time = strtotime($ngay_sinh);

                    $format_date = date('Y-m-d', $time);
                    $chuc_vu = $_POST['chucvu'];
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];
                        if($image_name!="")
                        {
                            $source_path = $_FILES['image']['tmp_name'];

                            $dess_path = "../image/image_database/".$image_name;

                            $upload = move_uploaded_file($source_path, $dess_path);
                            if($upload== FALSE)
                            {
                                die();
                            }
                        }
                    }
                    else
                    {
                        
                    }
                    
                    $sql = "INSERT INTO NhanVien(Ma_nv, Ten_nv, Gioi_tinh, Ngay_sinh, Chuc_vu, Mo_ta, Dia_chi, So_Dt) 
                    VALUES('$id_nv', N'$ten_nv', N'$gioitinh', '$format_date', N'$chuc_vu', '$image_name', N'$address', '$phone')";
                    $res =  sqlsrv_query($conn, $sql);
                    if($res > 0)
                    {
                        header("Location:nhanvien.php");
                    }
                    else
                    {
                        header("Location:add_nhanvien.php");   
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã nhân viên</span>
                <input type="text" class="form-control" name="ma_nv">
            </div>
            <div class="form-group">
                <span>Tên nhân viên</span>
                <input type="text" class="form-control" name="ten_nv">               
            </div>
            <div class="form-group">
                <span>Giới tính</span>
                <br>
                <select name="gender" id="">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <span>Ngày sinh</span>
                <input type="date" class="form-control" name="birthday">
            </div>
            <div class="form-group">
                <span>Chức vụ</span>
                <br>
                <select name="chucvu" id="">
                    <option value="Bảo vệ">Bảo vệ</option>
                    <option value="Seller">Seller</option>
                </select>
            </div>
            <div class="form-group">
                <span>Địa chỉ</span>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="form-group">
                <span>Số điện thoại</span>
                <input type="phone" class="form-control" name="phone">
            </div>
            <div class="gender">
                <span>Image</span>
                <br>
                <input type="file" name="image" class="file">
            </div>
            <input type="submit" name="submit" value="Thêm nhân viên" class="btn btn-add btn-add-connect">
            <a href="nhanvien.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>