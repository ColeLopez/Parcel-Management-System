<?php
    session_start();
    include_once 'config.php';

    $_SESSION['title'] = "Edit Branch";

    $_SESSION['login_id'];
    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    $id = $_GET["id"];
    $street = "";
    $city = "";
    $province = "";
    $zipcode = "";
    $country = "";
    $contact_num = "";
    
    $res = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.branch_details WHERE id = $id");

    while($row = mysqli_fetch_array($res)){
        $street = $row["street_building"];
        $city = $row["city"];
        $province = $row["province"];
        $zipcode = $row["zip_postal_code"];
        $country = $row["country"];
        $contact_num = $row["contact_num"];
    }

    include 'header.php';
?>
    <main>
        <div class="heading">Update branch</div>
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
        <form action="" method="POST">
        <div class="content-wrapper">
            <div class="row">
                <div class="column">
                    <label for="street">Street/Building</label>
                    <input type="text" name="street" value="<?php echo $street ?>" required>
                </div>
                
                <div class="column">
                    <label for="city">City</label>
                    <input type="text" name="city"  value="<?php echo $city ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="province">Province</label>
                    <input type="text" name="province" value="<?php echo $province ?>" required>
                </div>
                
                <div class="column">
                    <label for="zipcode">Zip Code/Postal Code</label>
                    <input type="text" name="zipcode" id="zipcode" value="<?php echo $zipcode?>" onkeypress="return /[0-9]/i.test(event.key)" maxlength="4" required>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="country">Country</label>
                    <input type="text" name="country"  value="<?php echo $country?>" required>
                </div>
                
                <div class="column">
                    <label for="contact_num">Contact Number</label>
                    <input type="text" name="contact_num"  id="contact_num" value="<?php echo $contact_num ?>" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" required>
                </div>
            </div>
            <div class="button-block">
                <input type="submit" id="update" name="update" value="Update"></input>
                <input type="button" onclick="window.location.href='list_branch.php'" id="cancel" name="cancel" value="Cancel"></input>
            </div>
        </div>
        <?php
            update_branch($conn);
        ?>
        </form>
    </main>
    
    <?php
        include 'footer.php';
    ?>
</body>
</html>