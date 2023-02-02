<?php
    session_start();
    include_once "config.php";

    $_SESSION['title'] = "Ready For Pickup Parcels";

    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    include "user_header.php";
?>
    <main>
        <section>
            <div class="heading">Ready For Pickup Parcel List</div>
            <div class="content-wrapper">

            <?php
                $result = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.parcel_details WHERE status_ = 'Ready for Pickup'");
            ?>
            
            <table class="list_branches">
                    <form method="POST">
                        <tr>
                            <th> ID </th>
                            <th> Reference Number </th>
                            <th> Sender Name </th>
                            <th> Recipient Name </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                        <?php
                            while($row = $result->fetch_assoc())
                            {
                        ?>
                        <tr>
                            <td> <?php echo $row['id']; ?></td>
                            <td> <?php echo $row["reference_number"]; ?> </td>
                            <td> <?php echo $row["sender_name"]; ?> </td>
                            <td> <?php echo $row["recipient_name"]; ?> </td>
                            <td> <?php echo $row["status_"]; ?> </td>
                            <td>
                                <a href="user_popup.php?id=<?php echo $row['id']; ?>">
                                    <i class="far fa-eye view"></i>
                                </a>
                                <a href="update_parcel.php?id=<?php echo $row["id"]; ?>">
                                    <i class="far fa-edit edit"></i>
                                </a>
                                <a onclick= " return myFunction() " href="delete_parcel.php?id=<?php echo $row["id"]; ?>">
                                    <i class="fas fa-trash-alt delete"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                            ?>
                    </form>
                </table>
                <script type="text/javascript">
                    function myFunction(){
                        if(confirm('Are you sure you want to delete this record')){
                            return true;
                        }
                        else{
                            return false;
                        }
                    }
                </script>
            </section>
        </form>
    </main>
<?php
    include "footer.php";
?>