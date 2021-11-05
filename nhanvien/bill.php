<?php
include('header.php');
?>
<main>
    <div class="add">
        <a href="add-bill.php" class="btn btn-add"><i class="fas fa-plus"></i>Thêm hóa đơn</a>
    </div>
    <section class="recent">
        <div class="activity-grid">
            <div class="activity-card">
                <h3>Danh sách hóa đơn</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Ngày hóa đơn</th>
                                <th>Tên nhân viên</th>
                                <th>Tên khách</th>
                                <th>Tên nhà vận chuyển</th>
                                <th>Địa chỉ nhận</th>
                                <th>Phí giao hàng</th>
                                <th>Tổng tiền</th>
                                <th>Chi tiết hóa đơn</th>
                                <th>Sửa thông tin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT Ma_hoadon, Ngay_hoadon, Ma_nv, Ma_khach, Ma_nvc, Dia_chinhan, Phi_ship, dbo.Func_2(Ma_hoadon) As TongTien 
                            from HOADON";
                            $res = sqlsrv_query($conn, $sql);
                            while ($row = sqlsrv_fetch_array($res)) {
                                $mahd = $row['Ma_hoadon'];
                                $ngayhd = $row['Ngay_hoadon'];
                                $manv = $row['Ma_nv'];
                                $mak = $row['Ma_khach'];
                                $manvc = $row['Ma_nvc'];
                                $diachi = $row['Dia_chinhan'];
                                $phiship = $row['Phi_ship'];
                                $tongtien = $row['TongTien'];
                            ?>
                                <tr>
                                    <td><?php echo $mahd; ?></td>
                                    <td><?php echo date_format($ngayhd, 'd-m-Y'); ?></td>
                                    <td>
                                        <?php
                                        $sql1 = "SELECT Ten_nv from NHANVIEN where Ma_nv = '$manv'";
                                        $res1 = sqlsrv_query($conn, $sql1);
                                        if ($res1 == true) {
                                            $row1 = sqlsrv_fetch_array($res1);
                                            $tennv = $row1['Ten_nv'];
                                        }
                                        echo $tennv;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sql2 = "SELECT Ten_khach from KHACHHANG where Ma_khach = '$mak'";
                                        $res2 = sqlsrv_query($conn, $sql2);
                                        if ($res2 == true) {
                                            $row2 = sqlsrv_fetch_array($res2);
                                            $tenk = $row2['Ten_khach'];
                                        }
                                        echo $tenk;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sql3 = "SELECT Ten_nvc from NHAVANCHUYEN where Ma_nvc = '$manvc'";
                                        $res3 = sqlsrv_query($conn, $sql3);
                                        if ($res3 == true) {
                                            $row3 = sqlsrv_fetch_array($res3);
                                            $tennvc = $row3['Ten_nvc'];
                                        }
                                        echo $tennvc;
                                        ?>
                                    </td>
                                    <td><?php echo $diachi; ?></td>
                                    <td><?php echo $phiship; ?></td>
                                    <td><?php echo $tongtien; ?></td>
                                    <td><a href="info-bill.php?Ma_hoadon=<?php echo $mahd; ?>"><i class="fas fa-info-circle"></i></a></td>
                                    <td><a href="update-bill.php?Ma_hoadon=<?php echo $mahd; ?>" class="btn btn-add"><i class="far fa-edit"></i></a></td>
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
    </div>
    <?php
    include('footer.php');
    ?>