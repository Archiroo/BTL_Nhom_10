<?php
include('header.php');
?>
<main>
    <div class="add">
        <a href="add-customer.php" class="btn btn-add"><i class="fas fa-plus"></i>Thêm khách hàng</a>
    </div>
    <section class="recent">
        <div class="activity-grid">
            <div class="activity-card">
                <h3>Danh sách khách hàng</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã khách hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Sửa thông tin</th>
                                <th>Xóa thông tin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * from KHACHHANG";
                            $res = sqlsrv_query($conn, $sql);
                            while ($row = sqlsrv_fetch_array($res)) {
                                $maK = $row['Ma_khach'];
                                $tenK = $row['Ten_khach'];
                                $gioitinh = $row['Gioi_tinh'];
                                $sdt = $row['So_dienThoai'];
                            ?>
                                <tr>
                                    <td><?php echo $maK; ?></td>
                                    <td><?php echo $tenK; ?></td>
                                    <td>
                                        <?php 
                                            if($gioitinh == 1){
                                                echo 'Nam';
                                            }
                                            else{
                                                echo 'Nữ';
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $sdt;?></td>
                                    <td><a href="update-customer.php?Ma_khach=<?php echo $maK;?>" class="btn btn-add"><i class="far fa-edit"></i></a></td>
                                    <td><a href="delete-customer.php?Ma_khach=<?php echo $maK;?>"><i class="fas fa-trash-alt"></i></a></td>
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