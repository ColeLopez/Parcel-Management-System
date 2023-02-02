<?php
    session_start();
    include "config.php";

    $_SESSION['title'] = "Update Parcel";

    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    $parcelID = $_GET["id"];

    $sender_name = "";
    $sender_address = "";
    $sender_contact_number = "";
    $recipient_name = "";
    $recipient_address = "";
    $recipient_contact_number = "";

    $type = "";
    $weight = "";
    $height = "";
    $length = "";
    $width = "";
    $price = "";

    $processedID = "";
    $pickupID = "";

    $res = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.parcel_details WHERE id = $parcelID");

    while($row = mysqli_fetch_array($res)){
        $from_fk_id = $row['from_branch_id'];
        $to_fk_id = $row['to_branch_id'];

        $sender_name = $row['sender_name'];
        $sender_address = $row['sender_address'];
        $sender_contact_number = $row['sender_contact'];
        
        $recipient_name = $row['recipient_name'];
        $recipient_address = $row['recipient_address'];
        $recipient_contact_number = $row['recipient_contact'];

        $type = $row['type_']; 
        $weight = $row['weight_'];
        $height = $row['height'];
        $length = $row['length_'];
        $quantity = $row['quantity'];
        $width = $row['width'];
        $price = $row['price'];
    }

    include 'header.php'
?>
<main>
    <div class="heading">Update Parcel</div>

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
    
    <form method="POST">
    <div class="content-wrapper">
        <div class="row">
            <div class="column">
                <label for="sender_info">Sender Information</label>
                <label name="sender_info" for="sender_name">Name</label>
                <input type="text" name="sender_name" id="sender_name" value="<?php echo $sender_name ?>" required>
            </div>
            
            <div class="column">
                <label for="recipient_info">Recipient Information</label>
                <label name="recipient_info" for="recipient_name">Name</label>
                <input type="text" name="recipient_name" id="recipient_name" value="<?php echo $recipient_name ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="sender_address">Address</label>
                <input type="text" name="sender_address" id="sender_address" value="<?php echo $sender_address ?>" required>
            </div>
            
            <div class="column">
                <label for="recipient_address">Address</label>
                <input type="text" name="recipient_address" id="recipient_address" value="<?php echo $recipient_address ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="sender_contact_number">Contact Number</label>
                <input type="text" name="sender_contact_number" id="sender_contact_number" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $sender_contact_number ?>" required>
            </div>
            
            <div class="column">
                <label for="recipient_contact_number">Contact Number</label>
                <input type="text" name="recipient_contact_number" id="recipient_contact_number" maxlength="10" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $recipient_contact_number ?>" required>
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
                                $processedID = ($row['id']);
                                if($processedID == $from_fk_id){ 
                                    echo "<option value = '". $row['id']."' selected='selected'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                }else{
                                    echo "<option value = '". $row['id']."'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                }
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
                                $pickupID = ($row['id']);
                                if($pickupID == $to_fk_id){ 
                                    echo "<option value = '". $row['id']."' selected='selected'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                }else{
                                    echo "<option value = '". $row['id']."'>" .$row['id'] .' | '. $row['street_building'] .', '. $row['city'] .', '. $row['province'] .', '. $row['zip_postal_code'] .', '. $row['country']."</option>";
                                }
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
                                <option disabled selected>-- Select Type --</option>
                                <?php
                                    $x = array(
                                        'Document' => 'Document',
                                        'Box' => 'Box',
                                        'Container' => 'Container'
                                    );
                                    foreach($x as $key => $val){
                                        $selected = ($val == $type) ? 'selected="selected"':'';
                                        echo '<option value="'. $val .'" ' . $selected . ' >'. $key .'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td> <input type="text" name="weight" id="weight" value="<?php echo $weight ?>" required></td>
                        <td> <input type="text" name="height" id="height" value="<?php echo $height ?>" required></td>
                        <td> <input type="text" name="length" id="length" value="<?php echo $length ?>" required></td>
                        <td> <input type="text" name="width" id="width" value="<?php echo $width ?>" required></td>
                        <td> <input type="number" name="quantity" id="quantity" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo intval($quantity) ?>" required></td>
                        <td> <input type="text" name="price" id="price" value="<?php echo $price ?>" required></td>
                    </tr>
            </table>
        </div>

        <div class="button-block">
            <input type="submit" id="update" name="update" value="Update"></input>
            <input type="button" onclick="window.location.href='list_parcels.php'" id="cancel" name="cancel" value="Cancel"></input>
        </div>
    </div>
        <?php
            if(update_parcel($conn)){
                ?>
                    <script> window.location.href='list_parcels.php'; </script>;
                <?php
            } 
        ?>
    </form>
</main>

<?php
    include 'footer.php';
?>