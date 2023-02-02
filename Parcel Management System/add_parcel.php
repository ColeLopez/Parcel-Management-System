<?php
    session_start();
    include "config.php";

    $_SESSION['title'] = "Add New Parcel";

    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    include 'header.php'
?>
<main>
    <div class="heading">New Parcel</div>
    
    <div class="message">
        <span id="success_parcel">
            <?php
                if (isset($_SESSION['success_parcel']))
                {
                    echo $_SESSION['success_parcel'];
                    unset($_SESSION['success_parcel']);
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
    
    <form action="add_parcel.php" method="POST">
    <div class="content-wrapper">
        <div class="row">
            <div class="column">
                <label for="sender_info">Sender Information</label>
                <label name="sender_info" for="sender_name">Name</label>
                <input type="text" name="sender_name" id="sender_name" placeholder="" required>
            </div>
            
            <div class="column">
                <label for="recipient_info">Recipient Information</label>
                <label name="recipient_info" for="recipient_name">Name</label>
                <input type="text" name="recipient_name" id="recipient_name" placeholder="" required>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="sender_address">Address</label>
                <input type="text" name="sender_address" id="sender_address" placeholder="" required>
            </div>
            
            <div class="column">
                <label for="recipient_address">Address</label>
                <input type="text" name="recipient_address" id="recipient_address" placeholder="" required>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="sender_contact_number">Contact Number</label>
                <input type="text" name="sender_contact_number" id="sender_contact_number" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" placeholder="" required>
            </div>
            
            <div class="column">
                <label for="recipient_contact_number">Contact Number</label>
                <input type="text" name="recipient_contact_number" id="recipient_contact_number" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" placeholder="" required>
            </div>
        </div>
        
        <div class="row">
            <div class="branch-column">
                <label for="custom-select">Branch Processed</label>
                <div class="custom-select" style="width:200px">
                    <select name="Option_processed">
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
            
            <div class="branch-column">
                <label for="custom-select">Pickup Branch</label>
                <div class="custom-select" style="width:200px">
                    <select name="Option_pickup">
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
        </div>
        
        <div class="parcel-add">
            <label for="parcel_info">Parcel Information</label>
            <table class="parcel_info">
                    <tr>
                        <th> Type </th>
                        <th> Weight </th>
                        <th> Height </th>
                        <th> Length </th>
                        <th> Width </th>
                        <th> Quantity </th>
                        <th> Price </th>
                    </tr>

                    <tr>
                        <td>
                            <select name="Option_type">
                                <option disabled selected>-- Select Branch --</option>
                                <option value="Document">Document</option>
                                <option value="Box">Box</option>
                                <option value="Container">Container</option>
                            </select>
                        </td>
                        <td> <input type="text" name="weight" id="weight" placeholder="" required></td>
                        <td> <input type="text" name="height" id="height" placeholder="" required></td>
                        <td> <input type="text" name="length" id="length" placeholder="" required></td>
                        <td> <input type="text" name="width" id="width" placeholder="" required></td>
                        <td> <input type="number" name="quantity" id="quantity" placeholder="" required></td>
                        <td> <input type="text" name="price" id="price" placeholder="" required></td>
                    </tr>
            </table>
        </div>

        <div class="button-block">
            <input type="submit" id="save" name="save" value="Save"></input>
            <input type="reset" id="cancel" name="cancel" value="Cancel"></input>
        </div>
    </div>
        <?php
            add_new_parcel($conn); 
        ?>
    </form>
</main>

<?php
    include 'footer.php';
?>