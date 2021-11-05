<?php
include('header.php')
?>
<h2 class="dash-title">Overiew</h2>
<div class="dash-cards">
    <div class="card-single">
        <div class="card-body">
            <span class="fas fa-money-check-alt"></span>
            <div>
                <h5>Hóa đơn</h5>
                <?php
                    $sql3 = "SELECT count(Ma_hoadon) as sohd from HOADON";
                    $res3 = sqlsrv_query($conn,$sql3);
                    $row3 = sqlsrv_fetch_array($res3);
                    $count3 = $row3['sohd'];
                ?>
                <h4><?php echo $count3; ?></h4>
                <a href="bill.php">
                    Xem tất cả
                </a>
            </div>
        </div>
    </div>
    <div class="card-single">
        <div class="card-body">
            <span class="fas fa-user-tie"></span>
            <div>
                <h5>Khách hàng</h5>
                <?php
                    $sql4 = "SELECT count(Ma_khach) as sokhach from KHACHHANG";
                    $res4 = sqlsrv_query($conn,$sql4);
                    $row4 = sqlsrv_fetch_array($res4);
                    $count4 = $row4['sokhach'];
                ?>
                <h4><?php echo $count4; ?></h4>
                <a href="customer.php">
                    Xem tất cả
                </a>
            </div>
        </div>
    </div>
</div>
<section class="recent">
    <div class="activity-grid">
        <div class="activity-card">
            <h3>Danh sách sản phẩm</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Số lượng tồn</th>
                            <th>Giá bán</th>
                            <th>Nhà cung cấp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT Ten_sp, Mo_ta, Gia_ban, So_luongTon, Ten_ncc from SANPHAM, NHACUNGCAP
                            where SanPham.Ma_ncc = NHACUNGCAP.Ma_ncc";
                        $res = sqlsrv_query($conn, $sql);
                        while ($row = sqlsrv_fetch_array($res)) {
                            $ten_sp = $row['Ten_sp'];
                            $mo_ta = $row['Mo_ta'];
                            $gia_ban = $row['Gia_ban'];
                            $sl_ton = $row['So_luongTon'];
                            $ten_ncc = $row['Ten_ncc'];
                        ?>
                            <tr>
                                <td><?php echo $ten_sp; ?></td>
                                <td><?php echo $mo_ta; ?></td>
                                <td><?php echo $gia_ban; ?></td>
                                <td><?php echo $sl_ton; ?></td>
                                <td><?php echo $ten_ncc; ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>