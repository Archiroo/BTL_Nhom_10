<?php
    include('header.php');
?>

    <main>
        <a href="add_nhanvien.php" class="btn btn-add"><i class="fas fa-user-plus"></i> Thêm nhân viên</a>
        <section class="recent">
            <div class="activity-grid">
                <div class="activity-card">
                    <h3>Recent activity</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã nv</th>
                                    <th>Tên nv</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Chức vụ</th>
                                    <th>Số dt</th>
                                    <th>Anh</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        $sql = "SELECT * FROM NHANVIEN";
                                        $res = sqlsrv_query($conn, $sql);
                                        while($row = sqlsrv_fetch_array($res))
                                        {
                                            $id_nv = $row['Ma_nv'];
                                            $name = $row['Ten_nv'];
                                            $gender = $row['Gioi_tinh'];
                                            $birth_day = $row['Ngay_sinh']->format('d-m-Y');
                                            $chuc_vu = $row['Chuc_vu'];
                                            $so_dt = $row['So_dt'];
                                            $address = $row['Dia_chi'];
                                            $anh = $row['Mo_ta'];
                                            $status = $row['Tinh_trang'];
                                        ?>
                                        <tr>
                                            <td><?php echo $id_nv;?></td>
                                            <td><?php echo $name;?></td>
                                            <td style="text-align: center;">
                                                <?php
                                                    if($gender==1)
                                                    {
                                                        echo "Nam";
                                                    }
                                                    if($gender==0)
                                                    {
                                                        echo "Nữ";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $birth_day;
                                                ?>
                                            </td>
                                            <td><?php echo $chuc_vu ?></td>
                                            <td><?php echo $so_dt ?></td>
                                            <td class="td-team" style="margin-left: 1.5rem;">
                                                <div class="img-1">
                                                    <img src="../image/<?php echo $anh;?>" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="update_nhanvien.php?id_nv=<?php echo $id_nv;?>" class="update-icon">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="delete_nhanvien.php?id_nv=<?php echo $id_nv;?>" class="delete-icon">
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