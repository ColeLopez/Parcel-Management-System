<?php
    include_once 'config.php';
    $sql = mysqli_query($conn,"DELETE FROM parcel_sa1_db.branch_staff_details WHERE id ='". $_GET["id"] . "'");
    mysqli_close($conn)
?>

<script>window.location.href="list_branch_staff.php";</script>