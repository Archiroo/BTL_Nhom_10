<?php
    include('header.php');
?>

    <main>
        <a href="thongke.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Quay lại</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>View</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã hóa đơn</th>
                                    <th>Ngày</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Mã khách</th>
                                    <th>Tên khách</th>
                                    <th>Số đt</th>
                                    <th>Địa chỉ nhận</th>
                                    <th>Phi ship</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM VIEW_3";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $mhd = $row['Ma_hoadon'];
                                            $ngay = $row['Ngay_hoadon']->format('d-m-Y');
                                            $ten_sp = $row['Ten_sp'];
                                            $mkhach = $row['Ma_Khach'];
                                            $tenkhach = $row['Ten_Khach'];
                                            $sdt = $row['So_dienthoai'];
                                            $dc = $row['Dia_chinhan'];
                                            $ship = $row['Phi_ship'];
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $mhd;?></td>
                                            <td><?php echo $ngay;?></td>
                                            <td><?php echo $ten_sp;?></td>
                                            <td style="text-align: center;"><?php echo $mkhach; ?></td>
                                            <td><?php echo $tenkhach; ?></td>
                                            <td><?php echo $sdt; ?></td>
                                            <td><?php echo $dc; ?></td>
                                            <td style="text-align: center;"><?php echo $ship; ?></td>
                                        </tr>
                                        <?php

                                        }

                                    ?>
                                    <td></td>
                                </tr>
                                
                                        
                                
                                        
                                <!-- <tr>
                                    <td>3</td>
                                    <td>Logo Design</td>
                                    <td>15 Aug, 2020</td>
                                    <td>22 Aug, 2020</td>
                                
                                    <td>
                                        <span class="badge warning">Processing</span>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
<?php
    include('footer.php');
?>