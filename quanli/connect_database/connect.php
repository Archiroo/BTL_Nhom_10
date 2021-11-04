<?php
    $serverName = "DESKTOP-KJNF2QE\SQLEXPRESS"; //Đức
    // $serverName = "LAPTOP-0DD47SSH\SQLEXPRESS"; //Long
    $connectionInfo = array("Database" => "BTL_CuaHangGiay", 'CharacterSet' => 'UTF-8');
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }


?>