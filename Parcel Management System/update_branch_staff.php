<?php
    session_start();
    include "config.php";

    $_SESSION['title'] = "Update Branch Staff";
    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }
    
    $staffID = $_GET["id"];
    $fName = "";
    $lName = "";
    $email = "";
    $branch = "";
    $password = "";
    $fk_id = "";
    
    $res = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.branch_staff_details WHERE id = $staffID");

    while($row = mysqli_fetch_array($res)){
        $fk_id = $row['branch_id'];
        $fName = $row['first_name'];
        $lName = $row['last_name'];
        $sel_branch = $row['branch'];
        $email = $row['email'];
        $password = $row['password_'];
    }

    include 'header.php'
?>
<main>
    <div class="heading">Update staff member</div>
    
    <div class="error-message">
        <span id="error">
            <?php
                if (isset($_SESSION['error-pass']))
                {
                    echo $_SESSION['error-pass'];
                    unset($_SESSION['error-pass']);
                }
            ?>
        </span>
    </div>

    <form method="POST">
        <div class="content-wrapper">
            <div class="row">
                <div class="column">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value = "<?php echo $fName ?>" required>
                </div>
                
                <div class="column">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value = "<?php echo $lName ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="branch">Branch</label>
                    <div class="custom-select" style="width:200px">
                        <select name="Option">
                        <option disabled selected>--Select Option--</option>
                            <?php
                                $branch = $conn->query("SELECT * FROM parcel_sa1_db.branch_details");
                                while($row = mysqli_fetch_array($branch)){
                                    $branch_id = ($row['id']);
                                    if($branch_id == $fk_id){ 
                                        echo "<option value = '". $row['id']."' selected='selected'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                    }else{
                                        echo "<option value = '". $row['id']."'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="column">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value = "<?php echo $email ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value = "<?php echo $password ?>" required>
                </div>
                
                <div class="column">
                    <label for="con_password">Confirm Password</label>
                    <input type="password" name="con_password" id="con_password" placeholder="" required>
                </div>
            </div>
            <div class="button-block">
                <input type="submit" id="update_staff" name="update_staff" value="Update"></input>
                <input type="button" onclick="window.location.href='list_branch_staff.php'" id="cancel" name="cancel" value="Cancel"></input>
            </div>
        </div>
        <?php
            update_branch_staff($conn);
        ?>
    </form>
</main>

<?php
    include 'footer.php';
?>