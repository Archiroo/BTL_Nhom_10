<?php
    include('connect_database/connect.php');
    if(isset($_GET['id_ncc'])){
        $id = $_GET['id_ncc'];
    }
    $sql = "DELETE From NHACUNGCAP Where Ma_ncc = '$id'";
    $res = sqlsrv_query($conn, $sql);
    if($res==true){
        // Nếu dúng thì xóa 
        header("Location:nhacungcap.php");
    }
    else{
        // Không xóa được thì chịu
        header("Location:nhacungcap.php");
    }
?>