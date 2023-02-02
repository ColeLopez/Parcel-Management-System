<?php
    $qry_branch = "SELECT * FROM parcel_sa1_db.branch_details";
    $res_branch = mysqli_query($conn,$qry_branch);
    $branch_num_rows = mysqli_num_rows($res_branch);
    
    $qry_staff = "SELECT * FROM parcel_sa1_db.branch_staff_details";
    $res_staff = mysqli_query($conn,$qry_staff);
    $staff_num_rows = mysqli_num_rows($res_staff);
    
    $qry_parcel = "SELECT * FROM parcel_sa1_db.parcel_details";
    $res_parcel = mysqli_query($conn,$qry_parcel);
    $parcel_num_rows = mysqli_num_rows($res_parcel);
    
    $qry_parcel_collected = "SELECT * FROM parcel_sa1_db.parcel_details where status_ = 'Collected' ";
    $res_parcel_collected = mysqli_query($conn,$qry_parcel_collected);
    $parcel_num_rows_collected = mysqli_num_rows($res_parcel_collected);

    $qry_parcel_courier = "SELECT * FROM parcel_sa1_db.parcel_details where status_ = 'Accepted By Courier' ";
    $res_parcel_courier = mysqli_query($conn,$qry_parcel_courier);
    $parcel_num_rows_courier = mysqli_num_rows($res_parcel_courier);

    $qry_parcel_transit = "SELECT * FROM parcel_sa1_db.parcel_details where status_ = 'In Transit' ";
    $res_parcel_transit = mysqli_query($conn,$qry_parcel_transit);
    $parcel_num_rows_transit = mysqli_num_rows($res_parcel_transit);

    $qry_parcel_pickup = "SELECT * FROM parcel_sa1_db.parcel_details where status_ = 'Ready for Pickup' ";
    $res_parcel_pickup = mysqli_query($conn,$qry_parcel_pickup);
    $parcel_num_rows_pickup = mysqli_num_rows($res_parcel_pickup);

    $qry_parcel_picked_up = "SELECT * FROM parcel_sa1_db.parcel_details where status_ = 'Picked Up' ";
    $res_parcel_picked_up = mysqli_query($conn,$qry_parcel_picked_up);
    $parcel_num_rows_picked_up = mysqli_num_rows($res_parcel_picked_up);

    $qry_parcel_delivered = "SELECT * FROM parcel_sa1_db.parcel_details where status_ = 'Delivered' ";
    $res_parcel_delivered = mysqli_query($conn,$qry_parcel_delivered);
    $parcel_num_rows_delivered = mysqli_num_rows($res_parcel_delivered);
?>