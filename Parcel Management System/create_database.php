<?php
    $host = 'localhost';        //Database server
    $user = 'root';             //Database username
    $pass = 'mysql';            //Database password

    // Create connection
    $conn = new mysqli($host, $user, $pass);
    
    try{
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Create database
        $sql = "CREATE SCHEMA parcel_sa1_db";
        if ($conn->query($sql) === TRUE) {
            echo '<script>';
                console_log("Database created successfully");
            echo '</script>';
        }
        $conn->close();
    }catch(mysqli_sql_exception $ex){
        die("Database connection failed:".mysqli_connect_error());
    }
?>