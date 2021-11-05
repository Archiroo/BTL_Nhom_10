<?php
    include('connect_database/connect.php');
    if(isset($_GET['id_nvc'])){
        $id = $_GET['id_nvc'];
    }
    $sql = "DELETE From NHAVANCHUYEN Where Ma_nvc = '$id'";
    $res = sqlsrv_query($conn, $sql);
    if($res==true){
        // Nếu dúng thì xóa 
        header("Location:nhavanchuyen.php");
    }
    else{
        // Không xóa được thì chịu
        header("Location:nhavanchuyen.php");
    }
?>