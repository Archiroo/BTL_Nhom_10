<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include('connect_database/connect.php');
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
            </tr>
        </thead>
        <tbody>
            <!-- CODE PHP -->
            <?php
                $sql = "SELECT * FROM NHACUNGCAP";
                $res = sqlsrv_query($conn, $sql);
                   
                        while ($row = sqlsrv_fetch_array($res)) {
                            $id_std = $row['Ma_ncc'];
                            $id_user = $row['Ten_ncc'];
            ?>
                        <tr>
                            <td><?php  echo $id_std; ?></td>
                            <td><?php  echo $id_user;?></td>
                        </tr>
            <?php
                        
                    
                }
                           
             
            ?>


        </tbody>
    </table>
</body>

</html>