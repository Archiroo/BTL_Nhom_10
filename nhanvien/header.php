<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="css/nhanvien.css">
    <title>Management website</title>
</head>

<body>
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="fas fa-store"></span>
                <span>Archive</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="ti-home"></span>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="customer.php">
                        <span class="fas fa-user-tie"></span>
                        <span>Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="bill.php">
                        <span class="fas fa-money-check-alt"></span>
                        <span>Hóa đơn</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="fas fa-power-off"></span>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="text" placeholder="Search">
            </div>
            <div class="social-icons">
                <div>
                    <img src="../image/user.png" alt="">
                </div>
            </div>
        </header>

