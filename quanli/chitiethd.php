<?php
    include('header.php');
    if(isset($_GET['ma_hd'])){
        $id = $_GET['ma_hd'];
    }
?>

    <main>
        <a href="thongkehd.php" class="btn btn-add"><i class="fas fa-arrow-left"></i> Quay lại</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>Chi tiết hóa đơn</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã hóa đơn</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Ảnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM VIEW_4 WHERE Ma_hd = '$id'";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $mahd = $row['Ma_hd'];
                                            $masp = $row['Ma_sp'];
                                            $tensp = $row['Ten_sp'];
                                            $sl = $row['So_luongBan'];
                                            $thanhtien = $row['ThanhTien'];
                                            $anh = $row['Anh'];
                                        ?>
                                        <tr>
                                            <td><?php echo $mahd;?></td>
                                            <td><?php echo $masp;?></td>
                                            <td><?php echo $tensp;?></td>
                                            <td style="text-align: center;"><?php echo $sl;?></td>
                                            <td style="text-align: center;"><?php echo $thanhtien;?></td>
                                            <td>
                                                <img src="../image/<?php echo $anh; ?>" alt="" width="50px">
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