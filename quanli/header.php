<?php
    include('connect_database/connect.php');
    // if(!isset($_SESSION['login-admin'])) //nếu khác admin thì ra ngoài
    // {
    //     header("Location:../index.php");
    // }


?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="css/quanli.css">
    <title>Management website</title>
</head>

<body>
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="las la-store"></span>
                <span>Archiro</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
            <!--nút 3 ghạch-->
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="nhanvien.php">
                        <span class="fas fa-user"></span>
                        <span>Nhân viên</span>
                    </a>
                </li>
                <li>
                    <a href="nhacungcap.php">
                        <i class="fas fa-bookmark"></i>
                        <span>Nhà cung cấp</span>
                    </a>
                </li>
                <li>
                    <a href="sanpham.php">
                        <span class="fas fa-folder"></span>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="nhavanchuyen.php">
                        <i class="fas fa-truck"></i>
                        <span>Nhà vận chuyển</span>
                    </a>
                </li>
                <li>
                    <a href="thongke.php">
                        <span class="fas fa-poll"></span>
                        <span>Thống kê</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- SEARCH -->
    <div class="main-content">
        <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="text" placeholder="Tìm kiếm" name="search">
            </div>
            <div class="social-icons">
                <div>
                    <img src="../image/nhanvien1.jpg" alt="">
                </div>
            </div>
        </header> 