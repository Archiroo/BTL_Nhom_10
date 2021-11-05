<?php
    include('header.php');
?>
<!-- CODE THÊM -->
    <main>
        <form action="" method="POST" class="register" enctype="multipart/form-data">
            <?php
                // CODE PHP
                if(isset($_POST['submit'])){
                    $id_sp = $_POST['ma_sp'];
                    $id_ncc = $_POST['ma_ncc'];
                    $ten_sp = $_POST['ten_sp'];
                    $gianhap = $_POST['gianhap'];
                    $giaban = $_POST['giaban'];
                    $sol = $_POST['sol'];
                    // $format_date = date('Y-m-d');
                    
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
                    
                    $sql = "INSERT INTO SANPHAM(Ma_sp, Ten_sp, Mo_ta, Gia_nhap, Gia_ban, So_luongTon, Ma_ncc)
                    Values('$id_sp', N'$ten_sp', '$image_name', '$gianhap', '$giaban', '$sol', '$id_ncc')";
                    $res =  sqlsrv_query($conn, $sql);
                    if($res > 0)
                    {
                        header("Location:sanpham.php");
                    }
                    else
                    {
                        header("Location:add_sanpham.php");   
                    }
                }
            ?>
            <div class="form-group  first-span">
                <span>Mã sản phẩm</span>
                <input type="text" class="form-control" name="ma_sp">
            </div>
            <div class="form-group">
                <span>Mã nhà cung cấp</span>
                <select name="ma_ncc" style="display:block;">
                    <?php
                    $sql = "SELECT * FROM NHACUNGCAP WHERE Tinh_trang = 1";
                    $res = sqlsrv_query($conn, $sql);
                    while($row = sqlsrv_fetch_array($res)) {
                            echo '<option value="' . $row['Ma_ncc'] . '">' . $row['Ma_ncc'] . '</option>';
                    }
                    ?>
                </select>                
            </div>
            <div class="form-group">
                <span>Tên sản phẩm</span>
                <input type="text" class="form-control" name="ten_sp">               
            </div>
            
            <div class="form-group">
                <span>Giá nhập</span>
                <input type="text" class="form-control" name="gianhap">
            </div>
            
            <div class="form-group">
                <span>Giá bán</span>
                <input type="text" class="form-control" name="giaban">
            </div>
            
            <div class="form-group">
                <span>Số lượng</span>
                <input type="text" class="form-control" name="sol">
            </div>
            <div class="gender">
                <span>Ảnh</span>
                <br>
                <input type="file" name="image" class="file">
            </div>
            <input type="submit" name="submit" value="Thêm sản phẩm" class="btn btn-add btn-add-connect">
            <a href="sanpham.php" class="btn btn-add btn-cancel">Cancel</a>
            <div style="margin-bottom: 5rem;">
            </div>
        </form>      
<?php
    include('footer.php');
?>