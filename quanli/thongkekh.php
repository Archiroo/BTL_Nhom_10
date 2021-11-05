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
                                    <th>Mã khách</th>
                                    <th>Tên khách</th>
                                    <th>Giới tính</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM VIEW_2";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $mak = $row['MaKhach'];
                                            $tenk = $row['TenKhach'];
                                            $gioitinh = $row['GioiTinh'];
                                            $sl = $row['SoLuongMua'];
                                            $tongtien = $row['TongTien'];
                                        ?>
                                        <tr>
                                            <td><?php echo $mak;?></td>
                                            <td><?php echo $tenk;?></td>
                                            <td><?php echo $gioitinh;?></td>
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo $tongtien; ?></td>
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