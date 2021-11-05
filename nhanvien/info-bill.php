<?php
include('header.php');
?>
<main>
<?php
    if (isset($_GET['Ma_hoadon'])) {
        $id = $_GET['Ma_hoadon'];
    }
?>
    <form action="" method="POST" class="register" enctype="multipart/form-data">
        <div class="form-group  first-span">
            <span>Mã sản phẩm</span>
            <br>
            <select name="sanpham" id="sanpham">
                <?php
                $sql1 = "SELECT * from SANPHAM";
                $res1 = sqlsrv_query($conn, $sql1);
                if ($res1 == true) {
                    while ($row1 = sqlsrv_fetch_array($res1)) {
                        $masp = $row1['Ma_sp'];
                        $tensp = $row1['Ten_sp'];
                ?>
                <option value="<?php echo $masp;?>"><?php echo $tensp;?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <span>số lượng bán</span>
            <br>
            <input type="text" class="form-control" name="soluong">
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Tính Tiền</button>
        </div>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $masp = $_POST['sanpham'];
            $soluong = $_POST['soluong'];

            $sql = "INSERT into CHITIETHD(Ma_hoadon, Ma_sp,So_luongBan)
            values ('$id','$masp','$soluong')
            ";
            $res= sqlsrv_query($conn, $sql);
            if($res==true){
                echo 'success';
            }
            else{
                echo 'fail';
            }
        }
    ?>
<?php
    include('footer.php');
?>