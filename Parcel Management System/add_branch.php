<?php
    session_start();
    include "config.php";
    $_SESSION['title'] = "New Branch";

    $_SESSION['login_id'];
    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    include 'header.php'
?>
<main>
    <div class="heading">Add new branch</div>
    
    <div class="message">
        <span id="success">
            <?php
                if (isset($_SESSION['success']))
                {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
            ?>
        </span>
    </div>

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

    <form action="add_branch.php" method="POST">
    <div class="content-wrapper">
        <div class="row">
            <div class="column">
                <label for="street">Street/Building</label>
                <input type="text" name="street" id="street" placeholder="" required>
            </div>
            
            <div class="column">
                <label for="city">City</label>
                <input type="text" name="city" id="city" placeholder="" required>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="province">Province</label>
                <input type="text" name="province" id="province" placeholder="" required>
            </div>
            
            <div class="column">
                <label for="zipcode">Zip Code/Postal Code</label>
                <input type="text" name="zipcode" id="zipcode" onkeypress="return /[0-9]/i.test(event.key)" maxlength="4"  required>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" placeholder="" required>
            </div>
            
            <div class="column">
                <label for="contact_num">Contact Number</label>
                <input type="text" name="contact_num" id="contact_num" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" required>

            </div>
        </div>
        <div class="button-block">
            <input type="submit" id="save" name="save" value="Save"></input>
            <input type="reset" id="cancel" name="cancel" value="Cancel"></input>
        </div>
    </div>
        <?php
            add_new_branch($conn);
        ?>
    </form>
</main>

<?php
    include 'footer.php';
?>