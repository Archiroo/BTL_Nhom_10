<?php
    include('header.php');
?>

    <main>
        <a href="add_nvc.php" class="btn btn-add"><i class="fas fa-plus"></i> Thêm nhà vận chuyển</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>View</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã nvc</th>
                                    <th>Tên nhà vận chuyển</th>
                                    <th>Số điện thoại</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM NHAVANCHUYEN WHERE Tinh_trang = 1";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $id_nvc = $row['Ma_nvc'];
                                            $ten_nvc = $row['Ten_nvc'];
                                            $sdt_nvc = $row['SDT_nvc'];
                                        ?>
                                        <tr>
                                            <td><?php echo $id_nvc;?></td>
                                            <td><?php echo $ten_nvc;?></td>
                                            <td><?php echo $sdt_nvc;?></td>
                                            <td>
                                                <a href="update_nvc.php?id_nvc=<?php echo $id_nvc;?>" class="update-icon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="delete_nvc.php?id_nvc=<?php echo $id_nvc;?>" class="delete-icon">
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