<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Education website</title>
</head>
<body>
    <!-- CSS cùng với sinh viên -->
    <div class="home">
        <h1>Education Support</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum neque aliquid similique error velit placeat vitae accusantium est nam magnam?</p>
        <a href="#" id="login-btn">
            <button class="btn btn-index">Get Started</button>
        </a>
    </div>
    <div class="login-form-container login">
        <div id="close-login-btn" class="fas fa-times"></div>
        <form action="login.php" method="POST">
            <h3>sign in</h3>
            <span>User name</span>
            <input type="text" name="user_name" class="box" placeholder="Enter your username" id="">
            <span>Pass word</span>
            <input type="password" name="user_pass" class="box" placeholder="Enter your password" id="">
            <div class="checkbox">
                <input type="checkbox" name="" class="remember-me">
                <label for="remember-me">Remember-me</label>
            </div>
            <!-- <input type="submit" value="Sign in" class="btn btn-sign-in" name="login"> -->
            <button type="submit" name="login" class="btn btn-sign-in">Sign in</button>
            <p>For get password ? <a href="#">Click Here</a></p>   
        </form>
    </div>
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- BOOSTRAP -->
    <!-- SCRIPT -->
    <script src="js/myscript.js"></script>
</body>
</html>