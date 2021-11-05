<?php
    include('header.php');
?>

    <main>
        <a href="thongke.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Quay lại</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>Bảng lương tháng 9</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã nv</th>
                                    <th>Tên nv</th>
                                    <th>Chức vụ</th>
                                    <th>Mức lương</th>
                                    <th>Số ngày</th>
                                    <th>Số hóa đơn</th>
                                    <th>Tổng lương</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "EXECUTE PROC_2";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $mhd = $row['Ma_nv'];
                                            $ngay = $row['Ten_nv'];
                                            $ten_sp = $row['Chuc_vu'];
                                            $mkhach = $row['Muc_luong'];
                                            $tenkhach = $row['So_ngayLam'];
                                            $sdt = $row['SoHoaDon'];
                                            $dc = $row['TongLuong'];
                                        ?>
                                        <tr>
                                            <td><?php echo $mhd;?></td>
                                            <td><?php echo $ngay;?></td>
                                            <td><?php echo $ten_sp;?></td>
                                            <td style="text-align: center;"><?php echo $mkhach; ?></td>
                                            <td style="text-align: center;"><?php echo $tenkhach; ?></td>
                                            <td style="text-align: center;"><?php echo $sdt; ?></td>
                                            <td><?php echo $dc; ?></td>
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