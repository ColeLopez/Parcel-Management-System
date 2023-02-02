<!DOCTYPE html>
<?php
    session_start();
    include "config.php";
    unset($_SESSION["login_id"]);
    unset($_SESSION["user-login_id"]);
    unset($_SESSION["username"]);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <div class="login-form">
        <p>Login</p>
        <div class="error-message">
            <span id="error">
                <?php
                    if (isset($_SESSION['error_login']))
                    {
                        echo $_SESSION['error_login'];
                        unset($_SESSION['error_login']);
                    }
                ?>
            </span>
        </div>
        <form class="login-details" method="POST" action="index.php">
            
            <input type="text" name="username" id="username" placeholder="Enter Username/ Email" required>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <input type="submit" name="submit" value="Login" class="btn btn-success"></input>
            <?php
                loginCheck($conn);
            ?>
        </form> 
    </div>
</body>
</html>


