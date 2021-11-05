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
                                    <th>Mã sp</th>
                                    <th>Tên sp</th>
                                    <th>Mã ncc</th>
                                    <th>Tên ncc</th>
                                    <th>Số lượng</th>
                                    <th>Tiền nhập</th>
                                    <th>Tiền bán</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM VIEW_5";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $msp = $row['Ma_sp'];
                                            $tensp = $row['Ten_sp'];
                                            $mancc = $row['Ma_ncc'];
                                            $tenncc = $row['Ten_ncc'];
                                            $slb = $row['Tong_slb'];
                                            $tiennhap = $row['Tong_tienNhap'];
                                            $tienban = $row['Tong_tienBan'];
                                            $doanhthu = $row['Tong_doanhThu'];
                                        ?>
                                        <tr>
                                            <td><?php echo $msp;?></td>
                                            <td><?php echo $tensp;?></td>
                                            <td><?php echo $mancc;?></td>
                                            <td><?php echo $tenncc;?></td>
                                            <td style="text-align:center;"><?php echo $slb;?></td>
                                            <td style="text-align:center;"><?php echo $tiennhap;?></td>
                                            <td style="text-align:center;"><?php echo $tienban;?></td>
                                            <td style="text-align:center;"><?php echo $doanhthu;?></td>
                                            
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