<?php
    include('quanli/connect_database/connect.php');

    if(isset($_POST['login']))
    {
        $user = $_POST['user_name'];
        $pass = $_POST['user_pass'];
        $sql = "SELECT * FROM tb_user WHERE user_name='$user' and user_pass = '$pass'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $user_id = $row['user_id'];
            $level = $row['user_level'];
            if($level == 1)
            {
                $_SESSION['login-admin'] = $user;
                header("Location:teacher/index.php");
            }
            if($level == 0)
            {   
                $_SESSION['user_id'] = $user_id;
                $_SESSION['login-student'] = $user;
                header('location: student/index.php');
            }
        }
        else{
            header("Location:index.php");
        }
    }
?>