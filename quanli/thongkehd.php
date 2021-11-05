<?php
    include('header.php');
?>

    <main>
        <a href="thongke.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Quay lại</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>Khách hàng</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã hóa đơn</th>
                                    <th>Tổng tiền</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT Ma_hoadon, ISNULL(dbo.Func_2(Ma_hoadon), 0) As TongTien From HoaDon";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $mahd = $row['Ma_hoadon'];
                                            $tongtien = $row['TongTien'];
                                        ?>
                                        <tr>
                                            <td><?php echo $mahd;?></td>
                                            <td><?php echo $tongtien;?></td>
                                            <td>
                                                <a href="chitiethd.php?ma_hd=<?php echo $mahd;?>" class="delete-icon">
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php

                                        }

                                    ?>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
<?php
    include('footer.php');
?>