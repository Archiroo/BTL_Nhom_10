<?php
include('connect.php');
if (isset($_GET['Ma_khach'])) {
    $id = $_GET['Ma_khach'];
    $sql = "DELETE from KHACHHANG where Ma_khach = '$id'";
    $res = sqlsrv_query($conn, $sql);
    if ($res == true) {
        header('location: customer.php');
    }
}
?>
