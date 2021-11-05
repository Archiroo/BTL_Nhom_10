<?php
    include('header.php');
?>

    <main>
        <a href="add_sanpham.php" class="btn btn-add"><i class="fas fa-user-plus"></i> Thêm sản phẩm</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>View</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã sp</th>
                                    <th>Mã ncc</th>
                                    <th>Tên sp</th>
                                    <th>Giá nhập</th>
                                    <th>Giá bán</th>
                                    <th>Số lượng</th>
                                    <th>Mô tả sản phẩm</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM SANPHAM WHERE Tinh_trang = 1";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $id_sp = $row['Ma_sp'];
                                            $id_ncc = $row['Ma_ncc'];
                                            $ten_sp = $row['Ten_sp'];
                                            $gianhap = $row['Gia_nhap'];
                                            $giaban = $row['Gia_ban'];
                                            $sl = $row['So_luongTon'];
                                            $anh = $row['Mo_ta'];
                                            
                                        ?>
                                        <tr>
                                            <td><?php echo $id_sp;?></td>
                                            <td><?php echo $id_ncc;?></td>
                                            <td><?php echo $ten_sp;?></td>
                                            <td style="text-align: center;"><?php echo $gianhap;?></td>
                                            <td style="text-align: center;"><?php echo $giaban;?></td>
                                            <td style="text-align: center;"><?php echo $sl;?></td>
                                            <td style="text-align: center;">
                                                <img src="../image/<?php echo $anh; ?>" alt="" width="100px">
                                            </td> 
                                            <td>
                                                <a href="update_sp.php?id_sp=<?php echo $id_sp;?>" class="update-icon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="delete_sp.php?id_sp=<?php echo $id_sp;?>" class="delete-icon">
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