<?php
    include('header.php');
?>

    <main>
        <a href="add_nhacc.php" class="btn btn-add"><i class="fas fa-plus"></i> Thêm nhà cung cấp</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>View</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã nhà cung cấp</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM NHACUNGCAP WHERE Tinh_trang = 1";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $id_ncc = $row['Ma_ncc'];
                                            $ten_ncc = $row['Ten_ncc'];
                                            $sdt_ncc = $row['SDT_ncc'];
                                            $diachi = $row['Diachi_ncc'];
                                        ?>
                                        <tr>
                                            <td><?php echo $id_ncc;?></td>
                                            <td><?php echo $ten_ncc;?></td>
                                            <td><?php echo $sdt_ncc;?></td>
                                            <td><?php echo $diachi; ?></td>
                                            <td>
                                                <a href="update_ncc.php?id_ncc=<?php echo $id_ncc;?>" class="update-icon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="delete_ncc.php?id_ncc=<?php echo $id_ncc;?>" class="delete-icon">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
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