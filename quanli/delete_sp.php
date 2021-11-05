<?php
    include('connect_database/connect.php');
    if(isset($_GET['id_sp'])){
        $id = $_GET['id_sp'];
    }
    $sql = "DELETE From SANPHAM Where Ma_sp = '$id'";
    $res = sqlsrv_query($conn, $sql);
    if($res==true){
        // Nếu dúng thì xóa 
        header("Location:sanpham.php");
    }
    else{
        // Không xóa được thì chịu
        header("Location:sanpham.php");
    }
?>