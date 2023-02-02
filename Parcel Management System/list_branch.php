<?php
    session_start();
    include_once "config.php";

    $_SESSION['title'] = "List Branches";
    
    $_SESSION['login_id'];
    if(!isset($_SESSION['login_id'])){
        header("Location: index.php");  
    }

    include "header.php";
?>
    <main>
        <section>
            <div class="heading">List of all branches</div>
            <div class="content-wrapper">

            <?php
                $result = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.branch_details");
            ?>
            
            <table class="list_branches">
                <tr>
                    <th> ID </th>
                    <th> Street/Building </th>
                    <th> City </th>
                    <th> Province </th>
                    <th> Zip/Postal Code </th>
                    <th> Country </th>
                    <th> Contact Number </th>
                    <th> Action </th>
                </tr>
                <?php
                    while($row = $result->fetch_assoc())
                    {
                ?>
                <tr>
                    <td> <?php echo $row["id"]; ?></td>
                    <td> <?php echo $row["street_building"]; ?> </td>
                    <td> <?php echo $row["city"]; ?> </td>
                    <td> <?php echo $row["province"]; ?> </td>
                    <td> <?php echo $row["zip_postal_code"]; ?>  </td>
                    <td> <?php echo $row["country"]; ?> </td>
                    <td> <?php echo $row["contact_num"]; ?> </td>
                    <td>
                        <a href="update_branch.php?id=<?php echo $row["id"]; ?>">
                            <i class="far fa-edit edit"></i>
                        </a>
                        <a onclick= " return myFunction() " href="delete_branch.php?id=<?php echo $row["id"]; ?>">
                            <i class="fas fa-trash-alt delete"></i>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
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
            </div>
        </section>
    </main>
<?php
    include "footer.php";
?>