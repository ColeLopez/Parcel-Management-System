<?php
    session_start();
    include_once "config.php";
    
    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }
    
    $parcelID = $_GET["id"];

    $res = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.parcel_details WHERE id = $parcelID");

    while($row = mysqli_fetch_array($res)){
        
        $from_fk_id = $row['from_branch_id'];
        $to_fk_id = $row['to_branch_id'];

        $ref = $row['reference_number'];
        $sender_name = $row['sender_name'];
        $sender_address = $row['sender_address'];
        $sender_contact_number = $row['sender_contact'];
        
        $recipient_name = $row['recipient_name'];
        $recipient_address = $row['recipient_address'];
        $recipient_contact_number = $row['recipient_contact'];

        $parcel_status = $row['status_'];
        $type = $row['type_'];
        $weight = $row['weight_'];
        $height = $row['height'];
        $length = $row['length_'];
        $width = $row['width'];
        $quantity = $row['quantity'];
        $price = $row['price'];
    }

    $query = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = $from_fk_id";
    $result = mysqli_query($conn,$query);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $street = $row['street_building'];
            $city = $row['city'];
            $province = $row['province'];
            $zipcode = $row['zip_postal_code'];
            $country = $row['country'];

            $branch_processed = $id . ' | '. $street . ', ' . $city .', ' . $province . ', ' . $zipcode . ', ' . $country  ;
        }
    }
    
    $query2 = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = $to_fk_id";
    $result2 = mysqli_query($conn,$query2);

    if($result2->num_rows > 0){
        while($row = $result2->fetch_assoc()){
            $id = $row['id'];
            $street = $row['street_building'];
            $city = $row['city'];
            $province = $row['province'];
            $zipcode = $row['zip_postal_code'];
            $country = $row['country'];

            $branch_pickup = $id . ' | '. $street . ', ' . $city .', ' . $province . ', ' . $zipcode . ', ' . $country  ;
        }
    }

    include "user_header.php";
?>
<main>
    <section>
    <div class="content-wrapper">
        <div class="form-popup" id="myForm">
            <form class="form-container">
                <div class="row">
                    <div class="tracking_number">
                        <label>Tracking Number</label>
                        <label><?php echo $ref?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <div class="sender">
                            <label><u>Sender Information</u></label>
                            <label><span class="label_heading">Name:</span></label>
                            <label><span class="label_sub"><?php echo $sender_name ?></span></label>
                            
                            <label><span class="label_heading">Address:</span></label>
                            <label><span class="label_sub"><?php echo $sender_address ?></span></label>
                            
                            <label><span class="label_heading">Contact:</span></label>
                            <label><span class="label_sub"><?php echo $sender_contact_number ?></span></label>
                        </div>
                    </div>
                    
                    <div class="column">
                        <div class="recipient">
                            <label><u>Recipient Information</u></label>
                            <label><span class="label_heading">Name:</span></label>
                            <label><span class="label_sub"><?php echo $recipient_name ?></span></label>
                            
                            <label><span class="label_heading">Address:</span></label>
                            <label><span class="label_sub"><?php echo $recipient_address ?></span></label>
                            
                            <label><span class="label_heading">Contact:</span></label>
                            <label><span class="label_sub"><?php echo $recipient_contact_number ?></span></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="column_parcel">
                        <div class="parcel_info">
                            <label><u>Parcel Information</u></label>
                            <label><span class="label_heading">Parcel Type: <? echo $type ?> </span></label>
                                <div class="row">
                                    <div class="column">
                                        <div>
                                            <label><span class="label_heading">Weight:</span></label>
                                            <label><span class="label_sub"><? echo $weight ?></span></label>
                                            
                                            <label><span class="label_heading">Width:</span></label>
                                            <label><span class="label_sub"><? echo $width ?></span></label>
                                            
                                            <label><span class="label_heading">Quantity:</span></label>
                                            <label><span class="label_sub"> <? echo $quantity ?> </span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="column">
                                        <div>
                                            <label><span class="label_heading">Height:</span></label>
                                            <label><span class="label_sub"><? echo $height ?></span></label>
                                            
                                            <label><span class="label_heading">Length:</span></label>
                                            <label><span class="label_sub"><? echo $length ?></span></label>
                                            
                                            <label><span class="label_heading">Price:</span></label>
                                            <label><span class="label_sub"><? echo $price ?></span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="column">
                                        <div class="">
                                            <label><span class="label_heading">Branch Accepted the Parcel:</span></label>
                                            <label><span class="label_sub"><?php echo $branch_processed ?></span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="column">
                                        <div>
                                            <label><span class="label_heading">Status:</span></label>
                                            <label>
                                                <span class="label_sub"> 
                                                    <?php echo $parcel_status ?>
                                                    <i class="far fa-edit edit" onclick="openDrop()">Update Status</i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="column">
                                        <div>
                                            <label><span class="label_heading">Nearest Branch to Recipient for Pickup:</span></label>
                                            <label><span class="label_sub"><?php echo $branch_pickup ?></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="button" onclick="window.location.href='user_list_parcels.php'" class="btn close" value="Close">
                    </div>
                </div>
            </form>
        </div>      

        <div class="dropdown-popup" id="myDrop">      
            <form class="form-dropdown" method="POST">
                    
                    <div class="drop">
                        <div class="drop-heading">
                            <label class="dropdown-head">Update status of: #<?php echo $ref?></label>
                        </div>
                        <div class="dropdown-menu">
                            <label class="drop-update">Update Status</label>  
                            <select name="status" id="status">
                                <option value="Collected">Collected</option>
                                <option value="Accepted By Courier">Item Accepted By Courier</option>
                                <option value="In Transit">In-Transit</option>
                                <option value="Ready for Pickup">Ready For Pickup</option>
                                <option value="Picked Up">Picked Up</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                        </div>
                        
                    </div> 
                    <div class="button_block">
                        <input type="submit" class="update_status" name="update_status" value="Update" onclick="window.location.reload()"/>

                        <button type="button" class="cancel_drop" onclick="closeDrop()">Cancel</button>
                    </div>
            </form>
            <?php
                if(isset($_POST['update_status'])){
                    $status = $_POST['status'];
                    if(!empty($_POST['status'])){           
                        $sql = "UPDATE parcel_sa1_db.parcel_details SET status_ ='$status' WHERE id = $parcelID";
                        mysqli_query($conn,$sql);
                    }
                }
            ?>
            <script>
                function openDrop() {
                    document.getElementById("myDrop").style.display = "block";
                }

                function closeDrop() {
                    document.getElementById("myDrop").style.display = "none";
                }

                    // JavaScript anonymous function
                (() => {
                    if (window.localStorage) {
        
                        // If there is no item as 'reload'
                        // in localstorage then create one &
                        // reload the page
                        if (!localStorage.getItem('reload')) {
                            localStorage['reload'] = true;
                            window.location.reload();
                        } else {
        
                            // If there exists a 'reload' item
                            // then clear the 'reload' item in
                            // local storage
                            localStorage.removeItem('reload');
                        }
                    }
                })(); // Calling anonymous function here only
            </script>
        </div>
    </div>
    </section>
</main>
<?php
    include "footer.php";
?>

