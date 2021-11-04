<?php
    include('connect_database/connect.php');
    if(isset($_GET['id_nv'])){
        $id = $_GET['id_nv'];
    }
    $sql = "DELETE From NHANVIEN Where Ma_nv = '$id'";
    $res = sqlsrv_query($conn, $sql);
    if($res==true){
        // Nếu dúng thì xóa 
        header("Location:nhanvien.php");
    }
    else{
        // Không xóa được thì chịu
        header("Location:nhanvien.php");
    }
?>