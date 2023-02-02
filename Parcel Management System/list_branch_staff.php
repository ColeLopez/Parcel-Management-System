<?php
    session_start();
    include_once "config.php";

    $_SESSION['title'] = "List Branch Staff";

    if(!isset($_SESSION['login_id'])){
        header("Location:index.php");
    }

    include "header.php";
?>
    <main>
        <section>
            <div class="heading">List of all branches</div>
            <div class="content-wrapper">

            <?php
                $result = mysqli_query($conn,"SELECT * FROM parcel_sa1_db.branch_staff_details");
            ?>
            
            <table class="list_branches">
                <tr>
                    <th> ID </th>
                    <th> Staff </th>
                    <th> Email </th>
                    <th> Branch </th>
                    <th> Action </th>
                </tr>
                <?php
                    while($row = $result->fetch_assoc())
                    {
                ?>
                <tr>
                    <td> <?php echo $row["id"]; ?></td>
                    <td> <?php echo $row["first_name"] .' '. $row['last_name']; ?> </td>
                    <td> <?php echo $row["email"]; ?> </td>
                    <td> <?php echo $row["branch"]; ?> </td>
                    <td>
                        <a href="update_branch_staff.php?id=<?php echo $row["id"]; ?>">
                            <i class="far fa-edit edit"></i>
                        </a>
                        <a onclick= " return myFunction() " href="delete_branch_staff.php?id=<?php echo $row["id"]; ?>">
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
                        window.location.href="list_branch.php";
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