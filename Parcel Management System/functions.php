<?php
    include_once "config.php";
    
    //error logging in the console
    function console_log($data, $add_script_tags = false) {
        $command = 'console.log('. json_encode($data, JSON_HEX_TAG).');';
        if ($add_script_tags) {
            $command = '<script>'. $command . '</script>';
        }
        echo $command;
    }

    function admin_table($conn){
        // sql to create table admin table
        $sql_admin = "CREATE TABLE admin_details (
            login_id INT(6) AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(30) NOT NULL,
            last_name VARCHAR(30) NOT NULL,
            username VARCHAR(30) NOT NULL,
            password_ VARCHAR(30) NOT NULL,
            role_ VARCHAR(10) NOT NULL)";
      
        if(mysqli_query($conn,$sql_admin))
        {
            echo '<script>';
                console_log('Table created');
            echo '</script>'; 
        }
    }

    function branch_table($conn){
        // sql to create branch table
        $sql_branch = "CREATE TABLE branch_details (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            street_building VARCHAR(30) NOT NULL,
            city VARCHAR(30) NOT NULL,
            province VARCHAR(30) NOT NULL,
            zip_postal_code VARCHAR(30) NOT NULL,
            country VARCHAR(30) NOT NULL,
            contact_num VARCHAR(10) NOT NULL)";
      
        if(mysqli_query($conn,$sql_branch))
        {
            echo '<script>';
                console_log('Table created');
            echo '</script>';
            
        }
    }

    function branch_staff_table($conn){
        // sql to create branch staff table
        $sql = "CREATE TABLE branch_staff_details (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            branch_id int(6) NOT NULL,
            FOREIGN KEY (branch_id) REFERENCES branch_details(id),
            first_name VARCHAR(300) NOT NULL,
            last_name VARCHAR(300) NOT NULL,
            email VARCHAR(300) NOT NULL,
            branch VARCHAR(300) NOT NULL,
            password_ VARCHAR(30) NOT NULL)";
      
        if(mysqli_query($conn,$sql))
        {
            echo '<script>';
                console_log('Table created');
            echo '</script>';
            
        }
    }

    function parcel_table($conn){
         // sql to create parcel table
         $sql_parcel = "CREATE TABLE parcel_details (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            reference_number INT(10),
            sender_name VARCHAR(30) NOT NULL,
            sender_address VARCHAR(30) NOT NULL,
            sender_contact VARCHAR(30) NOT NULL,
            recipient_name VARCHAR(30) NOT NULL,
            recipient_address VARCHAR(30) NOT NULL,
            recipient_contact VARCHAR(30) NOT NULL,
            from_branch_id INT(6) NOT NULL,
            FOREIGN KEY (from_branch_id) REFERENCES branch_details(id),
            to_branch_id INT(6) NOT NULL,
            FOREIGN KEY (to_branch_id) REFERENCES branch_details(id),
            type_ VARCHAR(30) NOT NULL,
            weight_ VARCHAR(30) NOT NULL,
            height VARCHAR(30) NOT NULL,
            length_ VARCHAR(30) NOT NULL,
            width VARCHAR(30) NOT NULL,
            quantity VARCHAR(30) NOT NULL,
            price VARCHAR(30) NOT NULL,
            status_ VARCHAR(30) NOT NULL)";
  
        if(mysqli_query($conn,$sql_parcel))
        {
            echo '<script>';
                console_log('Table created');
            echo '</script>';
            
        }
    }

    function admin($conn){
        //create admin details
        $fname = "Cole";
        $lname = "Lopez";
        $admin_username = "Myuser";
        $admin_password = "SA1@123";
        $admin_role = "admin";

        $check = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.admin_details WHERE username = '$admin_username'");

        if(mysqli_num_rows($check) > 0)
        {
            return false;
        }
        else{
            $sql = "INSERT INTO parcel_sa1_db.admin_details (login_id,first_name, last_name, username, password_, role_) 
                    VALUES(default,'$fname','$lname','$admin_username','$admin_password','$admin_role')";
            mysqli_query($conn,$sql);
            echo '<script>';
                    console_log('User created');
            echo '</script>';
        }
    }
    
    //admin login validation
    function admin_login($conn){

        if(isset($_POST['submit'])){

            if(isset($_POST['username']) && isset($_POST['password'])){
                $admin_username = $_POST['username'];
                $admin_password = $_POST['password'];

                $sanitized_username = mysqli_real_escape_string($conn,$admin_username);
                $sanitized_password = mysqli_real_escape_string($conn,$admin_password);

                $error = "Username or Password Incorrect!";
    
                $check = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.admin_details WHERE username = '$sanitized_username' 
                                        AND password_ ='$sanitized_password' AND role_ = 'admin'") or die(mysqli_error($conn));
                $row = mysqli_fetch_array($check);
    
                if(is_array($row)){
                    $_SESSION["login_id"] = $row['login_id'];
                    $_SESSION["username"] = $row['username'];
                }

                if(isset($_SESSION["login_id"])){
                    header("Location:dashboard.php");
                    exit();
                }
                else
                {
                    $_SESSION["error_login"] = $error;
                    header("Location:index.php");
                }
            }
        }
    }

    //user login validation
    function user_login($conn){
        if(isset($_POST['submit'])){

            if(isset($_POST['username']) && isset($_POST['password'])){
                $user_username = $_POST['username'];
                $user_password = $_POST['password'];

                $sanitized_username = mysqli_real_escape_string($conn,$user_username);
                $sanitized_password = mysqli_real_escape_string($conn,$user_password);

                $error = "Username or Password Incorrect!";
    
                $check = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.branch_staff_details WHERE email = '$sanitized_username' 
                                        AND password_ ='$sanitized_password'") or die(mysqli_error($conn));
                $row = mysqli_fetch_array($check);
    
                if(is_array($row)){
                    $_SESSION["login_id"] = $row['id'];
                    $_SESSION["username"] = $row['email'];
                }

                if(isset($_SESSION["login_id"])){
                    header("Location:user_dash.php");
                    exit();
                }
                else
                {
                    $_SESSION["error_login"] = $error;
                    header("Location:index.php");
                }
            }
        }
    }

    function loginCheck($conn){
        $error = "Username or Password Incorrect!";
        if(admin_login($conn)){
            admin_login($conn);
        }
        else if(user_login($conn)){
            user_login($conn);
        }
    }

    //add new branch
    function add_new_branch($conn){
        
        if(isset($_POST['save'])){

            $street = $_POST['street'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $zipcode = $_POST['zipcode'];
            $country = $_POST['country'];
            $contact_num = $_POST['contact_num'];
            
            $sanitized_street = mysqli_real_escape_string($conn,$street);
            $sanitized_city = mysqli_real_escape_string($conn,$city);
            $sanitized_province = mysqli_real_escape_string($conn,$province);
            $sanitized_zipcode = mysqli_real_escape_string($conn,$zipcode);
            $sanitized_country = mysqli_real_escape_string($conn,$country);
            $sanitized_contact_num = mysqli_real_escape_string($conn,$contact_num);

            $success = "Branch has been saved successfully";
            $error = "Invalid data";

            try 
            {
                $sql = "INSERT INTO parcel_sa1_db.branch_details (id, street_building, city, province, zip_postal_code, country, contact_num) 
                                VALUES(default,'$sanitized_street','$sanitized_city','$sanitized_province','$sanitized_zipcode',
                                '$sanitized_country','$sanitized_contact_num')";
                $runqry = mysqli_query($conn,$sql);
                
                if($runqry){

                    $_SESSION['success'] = $success;
                    echo "<script> window.location.href='add_branch.php'; </script>";
                }
                else{
                    $_SESSION['error'] = $error;
                    echo "<script> window.location.href='add_branch.php'; </script>";
                }
            } 
            catch (Exception $conn)
            {
                echo '<script>';
                    console_log("User creation failed: $conn->error");
                echo '</script>';
            }
        }
    }

    //update selected branch
    function update_branch($conn){
        
        if(isset($_POST['update'])){

            $id = $_GET["id"];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $zipcode = $_POST['zipcode'];
            $country = $_POST['country'];
            $contact_num = $_POST['contact_num'];
            
            $sanitized_street = mysqli_real_escape_string($conn,$street);
            $sanitized_city = mysqli_real_escape_string($conn,$city);
            $sanitized_province = mysqli_real_escape_string($conn,$province);
            $sanitized_zipcode = mysqli_real_escape_string($conn,$zipcode);
            $sanitized_country = mysqli_real_escape_string($conn,$country);
            $sanitized_contact_num = mysqli_real_escape_string($conn,$contact_num);

            $error = "Could Not Update";
            
            try {
                $sql = mysqli_query($conn,"UPDATE parcel_sa1_db.branch_details SET 
                        street_building = '$sanitized_street' , city = '$sanitized_city', province = '$sanitized_province',
                        zip_postal_code = '$sanitized_zipcode', country = '$sanitized_country', contact_num = '$sanitized_contact_num' 
                        WHERE id = $id") or die(mysqli_error($conn));
                mysqli_query($conn,$sql);
                ?> 
                    <script> window.location.href='list_branch.php'; </script>;
                <?php
            } catch (Exception $conn) {
                echo '<script>';
                    console_log("User creation failed: $conn->error");
                echo '</script>';
            }

        }
    }

    //add staff member to a branch
    function add_new_branch_staff($conn){
        
        if(isset($_POST['Option']) && isset($_POST['save_staff'])){

            $fName = $_POST['first_name'];
            $lName = $_POST['last_name'];
            $branchID = $_POST['Option'];

            $query = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = $branchID";
            $result = mysqli_query($conn,$query);

            $email = $_POST['email'];
            $password = $_POST['password'];
            $con_password = $_POST['con_password'];
            $error_pwd = "Invalid Password";

            $success_staff = "Staff member added";
            $error = "Invalid data";
            
            $sanitized_branchID = mysqli_real_escape_string($conn,$branchID);
            $sanitized_fname = mysqli_real_escape_string($conn,$fName);
            $sanitized_lname = mysqli_real_escape_string($conn,$lName);
            $sanitized_email = mysqli_real_escape_string($conn,$email);
            $sanitized_pass = mysqli_real_escape_string($conn,$password);


            try 
            {
                if($password != $con_password){
                    $_SESSION['error_staff'] = $error_pwd;
                        echo "<script> window.location.href='add_branch_staff.php'; </script>";
                }
                else{
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $id = $row['id'];
                            $street = $row['street_building'];
                            $city = $row['city'];
                            $province = $row['province'];
                            $zipcode = $row['zip_postal_code'];
                            $country = $row['country'];
    
                            $branch = $id . ' | '. $street . ', ' . $city .', ' . $province . ', ' . $zipcode . ', ' . $country  ;
                        }
                        
                        $sanitized_branch = mysqli_real_escape_string($conn,$branch);
    
                        $sql = "INSERT INTO parcel_sa1_db.branch_staff_details (id, branch_id, first_name, last_name, email, branch, password_) 
                                    VALUES(default,'$sanitized_branchID','$sanitized_fname','$sanitized_lname',
                                            '$sanitized_email','$sanitized_branch','$sanitized_pass')";
                        $runqry = mysqli_query($conn,$sql);
                        
                        if($runqry){
                            $_SESSION['success_staff'] = $success_staff;
                            echo "<script> window.location.href='add_branch_staff.php'; </script>";
                        }
                        else{
                            $_SESSION['error_staff'] = $error;
                            echo "<script> window.location.href='add_branch_staff.php'; </script>";
                        }
                    }
                }
               
            } 
            catch (Exception $conn)
            {
                echo '<script>';
                    console_log("User creation failed: $conn->error");
                echo '</script>';
            }
        }
    }

    //update staff member
    function update_branch_staff($conn){

        if(isset($_POST['update_staff'])){

            $id = $_GET["id"];

            if(!empty($_POST['Option'])){
                $branchID = $_POST['Option'];
            }
            
            $fName = $_POST['first_name'];
            $lName = $_POST['last_name'];
            $branchID = $_POST['Option'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $con_password = $_POST['con_password'];
            $error_pwd = "Invalid Password";
            
            $sanitized_fname = mysqli_real_escape_string($conn,$fName);
            $sanitized_lname = mysqli_real_escape_string($conn,$lName);
            $sanitized_branchID = mysqli_real_escape_string($conn,$branchID);
            $sanitized_email = mysqli_real_escape_string($conn,$email);
            $sanitized_pass = mysqli_real_escape_string($conn,$password);

            $query = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = '$branchID' ";
            $result = mysqli_query($conn,$query);
            try 
            {
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $branch_id = $row['id'];
                        $street = $row['street_building'];
                        $city = $row['city'];
                        $province = $row['province'];
                        $zipcode = $row['zip_postal_code'];
                        $country = $row['country'];

                        $branch = $branch_id . ' | '. $street . ', ' . $city .', ' . $province . ', ' . $zipcode . ', ' . $country  ;
                    }
                    $sanitized_branch = mysqli_real_escape_string($conn,$branch);
                }
                if($password != $con_password){
                        $_SESSION['error-pass'] = $error_pwd;
                    ?>
                        <script> window.location.href='update_branch_staff.php?id=<?php echo $id; ?>'; </script>;
                    <?php
                }
                else{
                    mysqli_query($conn,"UPDATE parcel_sa1_db.branch_staff_details SET branch_id='$sanitized_branchID',first_Name = '$sanitized_fname', 
                                    last_name = '$sanitized_lname', email = '$sanitized_email',
                                    branch = '$sanitized_branch', password_='$sanitized_pass' WHERE id = $id") or die(mysqli_error($conn));
                    ?>
                        <script> window.location.href='list_branch_staff.php'; </script>;
                    <?php
                }
            }
            catch (Exception $conn)
            {
                echo '<script>';
                    console_log("User creation failed: $conn->error");
                echo '</script>';
            }
        }
    }

    //add new parcel
    function add_new_parcel($conn){
        
        if(isset($_POST['Option_processed']) && isset($_POST['Option_processed']) && isset($_POST['Option_type']) && isset($_POST['save'])){

            $sender_name = mysqli_real_escape_string($conn,$_POST['sender_name']);
            $sender_address = mysqli_real_escape_string($conn,$_POST['sender_address']);
            $sender_contact_number = mysqli_real_escape_string($conn,$_POST['sender_contact_number']);
            
            $recipient_name = mysqli_real_escape_string($conn,$_POST['recipient_name']);
            $recipient_address = mysqli_real_escape_string($conn,$_POST['recipient_address']);
            $recipient_contact_number = mysqli_real_escape_string($conn,$_POST['recipient_contact_number']);

            $branch_processed = mysqli_real_escape_string($conn,$_POST['Option_processed']);

            $branch_pickup = mysqli_real_escape_string($conn,$_POST['Option_pickup']);

            $parcel_type = mysqli_real_escape_string($conn,$_POST['Option_type']);

            $weight = mysqli_real_escape_string($conn,$_POST['weight']);
            $height = mysqli_real_escape_string($conn,$_POST['height']);
            $length = mysqli_real_escape_string($conn,$_POST['length']);
            $width = mysqli_real_escape_string($conn,$_POST['width']);
            $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);
            
            $status = "Collected";
            
            $success_parcel = "Parcel saved successfully";
            $error = "Invalid data";

            $min = 000000000;
            $max = 999999999;

            $ref_num = mt_rand($min,$max);

            try 
            {
                $sql = "INSERT INTO parcel_sa1_db.parcel_details (id, reference_number, sender_name, sender_address, sender_contact,
                recipient_name, recipient_address, recipient_contact, from_branch_id, to_branch_id, type_,
                weight_, height, length_, width, quantity, price, status_) 
                VALUES(default,'$ref_num','$sender_name','$sender_address','$sender_contact_number',
                        '$recipient_name','$recipient_address','$recipient_contact_number',
                        '$branch_processed','$branch_pickup','$parcel_type','$weight','$height','$length','$width',
                        '$quantity','$price','$status')";
                        
                $run_qry = mysqli_query($conn,$sql);
                
                if($run_qry){
                    $_SESSION['success_parcel'] = $success_parcel;
                    echo "<script> window.location.href='add_parcel.php'; </script>";
                }
                else{
                    $_SESSION['error'] = $error;
                    echo "<script> window.location.href='add_parcel.php'; </script>";
                }
            }
            catch (Exception $conn)
            {
                echo '<script>';
                    console_log("User creation failed: $conn->error");
                echo '</script>';
            }
        }
    }

    //add new parcel
    function user_add_new_parcel($conn){
        
        if(isset($_POST['Option_processed']) && isset($_POST['Option_processed']) && isset($_POST['Option_type']) && isset($_POST['save'])){

            $sender_name = mysqli_real_escape_string($conn,$_POST['sender_name']);
            $sender_address = mysqli_real_escape_string($conn,$_POST['sender_address']);
            $sender_contact_number = mysqli_real_escape_string($conn,$_POST['sender_contact_number']);
            
            $recipient_name = mysqli_real_escape_string($conn,$_POST['recipient_name']);
            $recipient_address = mysqli_real_escape_string($conn,$_POST['recipient_address']);
            $recipient_contact_number = mysqli_real_escape_string($conn,$_POST['recipient_contact_number']);

            $branch_processed = mysqli_real_escape_string($conn,$_POST['Option_processed']);

            $branch_pickup = mysqli_real_escape_string($conn,$_POST['Option_pickup']);

            $parcel_type = mysqli_real_escape_string($conn,$_POST['Option_type']);

            $weight = mysqli_real_escape_string($conn,$_POST['weight']);
            $height = mysqli_real_escape_string($conn,$_POST['height']);
            $length = mysqli_real_escape_string($conn,$_POST['length']);
            $width = mysqli_real_escape_string($conn,$_POST['width']);
            $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);
            
            $status = "Collected";
            
            $success_parcel = "Parcel saved successfully";
            $error = "Invalid data";

            $min = 000000000;
            $max = 999999999;

            $ref_num = mt_rand($min,$max);

            try 
            {
                $sql = "INSERT INTO parcel_sa1_db.parcel_details (id, reference_number, sender_name, sender_address, sender_contact,
                recipient_name, recipient_address, recipient_contact, from_branch_id, to_branch_id, type_,
                weight_, height, length_, width, quantity, price, status_) 
                VALUES(default,'$ref_num','$sender_name','$sender_address','$sender_contact_number',
                        '$recipient_name','$recipient_address','$recipient_contact_number',
                        '$branch_processed','$branch_pickup','$parcel_type','$weight','$height','$length','$width',
                        '$quantity','$price','$status')";
                        
                $run_qry = mysqli_query($conn,$sql);
                
                if($run_qry){
                    $_SESSION['success_parcel'] = $success_parcel;
                    echo "<script> window.location.href='user_add_parcel.php'; </script>";
                }
                else{
                    $_SESSION['error'] = $error;
                    echo "<script> window.location.href='user_add_parcel.php'; </script>";
                }
            }
            catch (Exception $conn)
            {
                echo '<script>';
                    console_log("User creation failed: $conn->error");
                echo '</script>';
            }
        }
    }

    //update parcel
    function update_parcel($conn){

        if(isset($_POST['update'])){

            $sender_name = mysqli_real_escape_string($conn,$_POST['sender_name']);
            $sender_address = mysqli_real_escape_string($conn,$_POST['sender_address']);
            $sender_contact_number = mysqli_real_escape_string($conn,$_POST['sender_contact_number']);
            
            $recipient_name = mysqli_real_escape_string($conn,$_POST['recipient_name']);
            $recipient_address = mysqli_real_escape_string($conn,$_POST['recipient_address']);
            $recipient_contact_number = mysqli_real_escape_string($conn,$_POST['recipient_contact_number']);

            $weight = mysqli_real_escape_string($conn,$_POST['weight']);
            $height = mysqli_real_escape_string($conn,$_POST['height']);
            $length = mysqli_real_escape_string($conn,$_POST['length']);
            $width = mysqli_real_escape_string($conn,$_POST['width']);
            $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);

            $id = $_GET["id"];
            $error = "Invalid data";

            try 
            {
                if(!empty($_POST['Option_processed']) && !empty($_POST['Option_pickup']) && !empty($_POST['Option_type'])){
                    $branch_processed = mysqli_real_escape_string($conn,$_POST['Option_processed']);
                    $branch_pickup = mysqli_real_escape_string($conn,$_POST['Option_pickup']);
                    $parcel_type = mysqli_real_escape_string($conn,$_POST['Option_type']);
                }

                $query1 = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = '$branch_processed' ";
                $result1 = mysqli_query($conn,$query1);
                    if($result1->num_rows > 0){
                        while($row = $result1->fetch_assoc()){
                            $from_branch_id = $row['id'];
                        }
                    }
                
                $query2 = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = '$branch_pickup' ";
                $result2 = mysqli_query($conn,$query2);
                    if($result2->num_rows > 0){
                        while($row = $result2->fetch_assoc()){
                            $to_branch_id = $row['id'];
                        }
                    }

                $sql = "UPDATE parcel_sa1_db.parcel_details SET sender_name='$sender_name',sender_address = '$sender_address' , 
                                sender_contact = '$sender_contact_number', recipient_name = '$recipient_name',recipient_address ='$recipient_address',
                                recipient_contact = '$recipient_contact_number',  from_branch_id = '$from_branch_id', to_branch_id = '$to_branch_id',
                                type_ = '$parcel_type' ,weight_ = '$weight',height = '$height', length_ = '$length', quantity = '$quantity', 
                                width = '$width', price = '$price' WHERE id = $id";
                mysqli_query($conn,$sql);
                ?>
                    <script> window.location.href='list_parcels.php'; </script>;
                <?php
            }
            catch (Exception $conn)
            {

            }
        }
    }

    //update parcel
    function user_update_parcel($conn){

        if(isset($_POST['update'])){

            $sender_name = mysqli_real_escape_string($conn,$_POST['sender_name']);
            $sender_address = mysqli_real_escape_string($conn,$_POST['sender_address']);
            $sender_contact_number = mysqli_real_escape_string($conn,$_POST['sender_contact_number']);
            
            $recipient_name = mysqli_real_escape_string($conn,$_POST['recipient_name']);
            $recipient_address = mysqli_real_escape_string($conn,$_POST['recipient_address']);
            $recipient_contact_number = mysqli_real_escape_string($conn,$_POST['recipient_contact_number']);

            $weight = mysqli_real_escape_string($conn,$_POST['weight']);
            $height = mysqli_real_escape_string($conn,$_POST['height']);
            $length = mysqli_real_escape_string($conn,$_POST['length']);
            $width = mysqli_real_escape_string($conn,$_POST['width']);
            $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);

            $id = $_GET["id"];
            $error = "Invalid data";

            try 
            {
                if(!empty($_POST['Option_processed']) && !empty($_POST['Option_pickup']) && !empty($_POST['Option_type'])){
                    $branch_processed = mysqli_real_escape_string($conn,$_POST['Option_processed']);
                    $branch_pickup = mysqli_real_escape_string($conn,$_POST['Option_pickup']);
                    $parcel_type = mysqli_real_escape_string($conn,$_POST['Option_type']);
                }

                $query1 = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = '$branch_processed' ";
                $result1 = mysqli_query($conn,$query1);
                    if($result1->num_rows > 0){
                        while($row = $result1->fetch_assoc()){
                            $from_branch_id = $row['id'];
                        }
                    }
                
                $query2 = "SELECT * FROM parcel_sa1_db.branch_details WHERE id = '$branch_pickup' ";
                $result2 = mysqli_query($conn,$query2);
                    if($result2->num_rows > 0){
                        while($row = $result2->fetch_assoc()){
                            $to_branch_id = $row['id'];
                        }
                    }

                $sql = "UPDATE parcel_sa1_db.parcel_details SET sender_name='$sender_name',sender_address = '$sender_address' , 
                                sender_contact = '$sender_contact_number', recipient_name = '$recipient_name',recipient_address ='$recipient_address',
                                recipient_contact = '$recipient_contact_number',  from_branch_id = '$from_branch_id', to_branch_id = '$to_branch_id',
                                type_ = '$parcel_type' ,weight_ = '$weight',height = '$height', length_ = '$length', quantity = '$quantity', 
                                width = '$width', price = '$price' WHERE id = $id";
                mysqli_query($conn,$sql);
                ?>
                    <script> window.location.href='user_list_parcels.php'; </script>;
                <?php
            }
            catch (Exception $conn)
            {

            }
        }
    }
?>