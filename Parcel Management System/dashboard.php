<?php
    session_start();
    include_once "config.php";
    
    $_SESSION['login_id'];
    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }
    
    $_SESSION['title'] = "Dashboard";
    include "dashboard_information.php";
    include "header.php";
?>
    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1><?php echo $branch_num_rows ?></h1>
                    <span>Branch</span>
                </div>
                <div>
                    <span class="fas fa-building building "></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $staff_num_rows ?></h1>
                    <span>Branch Staff</span>
                </div>
                <div>
                    <span class="fas fa-users users"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows ?></h1>
                    <span>Total Parcels</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>
            
            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows_collected ?></h1>
                    <span>Collected Parcels</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows_courier ?></h1>
                    <span>Accepted By Courier</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows_transit?></h1>
                    <span>In Transit</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows_pickup ?></h1>
                    <span>Ready for Pickup</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows_picked_up ?></h1>
                    <span>Picked Up</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1><?php echo $parcel_num_rows_delivered ?></h1>
                    <span>Delivered</span>
                </div>
                <div>
                    <span class="fas fa-boxes boxes"></span>
                </div>
            </div>

        </div>
    </main>
</div>
<?php
include "footer.php";
?>