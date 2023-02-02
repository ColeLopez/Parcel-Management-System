<?php
    include_once "create_database.php";
    include_once "functions.php";

    $host = 'localhost';        //Database server
    $user = 'root';             //Database username
    $pass = 'mysql';            //Database password
    $data = 'parcel_sa1_db';    //Database name
    
    try{
        //Create connection
        $conn = new mysqli($host,$user,$pass,$data);
        
        if(!$conn)
        {
            die("Database connection failed:".mysqli_connect_error());
        }
        ($conn);
        admin_table($conn);
        branch_table($conn);
        branch_staff_table($conn);
        parcel_table($conn);
        admin($conn);
    }
    catch(Exception $e)
    {
        die("Database connection failed:".mysqli_connect_error());
    }
?>