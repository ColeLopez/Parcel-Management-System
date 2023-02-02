<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo $_SESSION['title'] ?></title>

    <!-- ========== CSS ========== -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- ========== Fontawesome CSS ========= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script  src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>

<!-- sidebar -->
<nav class="sidebar" id="nav">
        <header>
            <div class="image-text">
                <span class="image">
                    <i class="fas fa-biohazard"></i>
                </span>
                <div class="text header-text">
                    <span class="name">Admin</span>
                </div>
            </div>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul id="menu-links" class="menu-links">

                    <li class="nav-link">
                        <a class="" href="Dashboard.php">
                            <i class="fas fa-home icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <div class="icon-link">
                        <li class="nav-link" id="nav-link">
                            <a>
                                <i class="fas fa-building icon"></i>
                                <span class="text nav-text">Branch</span>
                                <i class="fas fa-caret-down dropdown"></i>
                            </a>
                        </li>
                        <div class="sub-menu">
                            <li><a href="add_branch.php">Add New</a></li>
                            <li><a href="list_branch.php">List</a></li>
                        </div>
                    </div>
                    
                    <div class="icon-link">
                        <li class="nav-link">
                            <a class="">
                                <i class="fas fa-users icon"></i>
                                <span class="text nav-text">Branch Staff</span>
                                <i class="fas fa-caret-down dropdown"></i>
                            </a>
                        </li>
                        <div class="sub-menu">
                            <li><a href="add_branch_staff.php">Add New</a></li>
                            <li><a href="list_branch_staff.php">List</a></li>
                        </div>
                    </div>
                    
                    <div class="icon-link">
                        <li class="nav-link">
                            <a class="">
                                <i class="fas fa-boxes icon"></i>
                                <span class="text nav-text">Parcel</span>
                                <i class="fas fa-caret-down dropdown"></i>
                            </a>
                        </li>
                        <div class="sub-menu">
                            <li><a href="add_parcel.php">Add New</a></li>
                            <li><a href="list_parcels.php">List All</a></li>
                            <li><a href="list_collected_parcel.php">Collected Parcels</a></li>
                            <li><a href="list_accepted_courier.php">Accepted by Courier</a></li>
                            <li><a href="list_in_transit_parcel.php">In Transit</a></li>
                            <li><a href="list_ready_for_pickup_parcel.php">Ready for Pickup</a></li>
                            <li><a href="list_picked_up_parcel.php">Picked Up</a></li>
                            <li><a href="list_delivered_parcel.php">Delivered</a></li>
                        </div>
                    </div>
                </ul>
            </div>

            <div class="bottom-content">
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt icon"></i>
                        <div class="text nave-text">Logout</div>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <script type="text/javascript" src="script.js"></script>

<div class="main-content">
    <header>
        <h2>
            <i class="fas fa-bars toggle"></i>
            <span>Dashboard</span>
        </h2>

        <div class="user-wrapper"> 
            <div>
                <i class="fas fa-user-circle"></i>
                <span>
                    <?php 
                        if($_SESSION["username"]){
                            echo $_SESSION["username"];
                        }
                    ?>
                </span>
            </div>
        </div>
    </header>