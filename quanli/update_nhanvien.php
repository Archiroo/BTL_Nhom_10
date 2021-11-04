<?php
    include('header.php');
    if(isset($_GET['id_nv'])){
        $id = $_GET['id_nv'];
    }
?>
<!-- CODE THÊM -->
    <main>
        <form action="" method="POST" class="register" enctype="multipart/form-data">
            <?php
                // CODE PHP
                // HIỂN THỊ
                
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