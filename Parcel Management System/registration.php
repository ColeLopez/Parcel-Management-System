<!DOCTYPE html>
<?php
    session_start();
    include "config.php";
    $_SESSION['title'] = "User registration";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $_SESSION['title']?> </title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <div class="reg-form">
        <p>Registration</p>
        <div class="error-message">
            <span id="error">
                <?php
                    if (isset($_SESSION['error']))
                    {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
            </span>
        </div>

        <form class="reg-details" method="POST" action="user_registration.php">
            
            <input type="text" name="fname" id="fname" placeholder="Enter First Name" required>
            <input type="text" name="lname" id="lname" placeholder="Enter Last Name" required>
            <input type="text" name="email" id="email" placeholder="Enter Email Address" required>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <input type="password" name="con_password" id="con_password" placeholder="Confirm Password" required>

            <div class="row">
                <div class="column">
                    <div class="custom-select" style="width:200px">
                        <select name="Option">
                            <option disabled selected>-- Select Your Branch --</option>
                            <?php
                                $branch = mysqli_query($conn,"SELECT * FROM db_main.branch_details");
                                while($row = mysqli_fetch_array($branch)){
                                    echo "<option value = '". $row['id']."'>" .$row['id'] .' | '. $row['_street_building'] .', '. $row['_city'] .', '. $row['_province'] .', '. $row['_zip_postal_code'] .', '. $row['_country']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Register" class="btn btn-success"></input>

        </form> 
    </div>
</body>
</html>