<?php
    session_start();
    include "config.php";

    $_SESSION['title'] = "New Branch Staff";

    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    include 'header.php'
?>
    <main>
        <div class="heading">Add new branch staff member</div>
        
        <div class="message">
            <span id="success_staff">
                <?php
                    if (isset($_SESSION['success_staff']))
                    {
                        echo $_SESSION['success_staff'];
                        unset($_SESSION['success_staff']);
                    }
                ?>
            </span>
        </div>
        
        <div class="error-message">
            <span id="error">
                <?php
                    if (isset($_SESSION['error_staff']))
                    {
                        echo $_SESSION['error_staff'];
                        unset($_SESSION['error_staff']);
                    }
                ?>
            </span>
        </div>

        <form action="add_branch_staff.php" method="POST">
        <div class="content-wrapper">
            <div class="row">
                <div class="column">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="" required>
                </div>
                
                <div class="column">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="branch">Branch</label>
                    <div class="custom-select" style="width:200px">
                        <select name="Option">
                            <option disabled selected>-- Select Branch --</option>
                            <?php
                                $branch = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.branch_details");
                                while($row = mysqli_fetch_array($branch)){
                                    echo "<option value = '". $row['id']."'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="column">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="" required>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="" required>
                </div>
                
                <div class="column">
                    <label for="con_password">Confirm Password</label>
                    <input type="password" name="con_password" id="con_password" placeholder="" >
                </div>
            </div>
            <div class="button-block">
                <input type="submit" id="save_staff" name="save_staff" value="Save"></input>
                <input type="reset" id="cancel" name="cancel" value="Cancel"></input>
            </div>
        </div>
            <?php
                add_new_branch_staff($conn);
            ?>
        </form>
    </main>

<?php
    include 'footer.php';
?>