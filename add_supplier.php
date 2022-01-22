<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h3 class="alert alert-primary text-center">Add Supplier</h3>


    <div class="container">
        <form action="" method="post">
            <label for="sname" class="text-danger">Supplier Name *</label>
            <input class="form-control form-control-sm" type="text" name="sname" placeholder="Supplier Name" required>

            <label for="smob" class="text-danger">Mobile *</label>
            <input class="form-control form-control-sm" type="text" name="smob" placeholder="Eg- 9876xx3210" required>

            <label for="semail" class="text-danger">Email *</label>
            <input class="form-control form-control-sm" type="email" name="semail" placeholder="Eg- abc@abc.com" required>

            <label for="sadds" class="text-danger">Address *</label>
            <input class="form-control form-control-sm" type="text" name="sadds" placeholder="Eg- Paltan Bazar, Ghy" required>

            <br>
            <button class="btn btn-primary btn-sm btn-block" name="addsupplier">Add Supplier</button>
            <br>

            <p class="text-center text-danger">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </p>
        </form>
    </div>
</div>
<br>
<?php require_once 'menu/footer.php' ?>


<?php

if (isset($_POST['addsupplier'])) {
    $sname = $_POST['sname'];
    $smob = $_POST['smob'];
    $semail = $_POST['semail'];
    $sadds = $_POST['sadds'];


    // $sql = "SELECT * FROM `user` JOIN `supplier` ON `user`.`id`=`supplier`.`id` WHERE `user`.`name` = '$sname' AND `user`.`mobile` = '$smob'
    // AND `supplier`.`address` = '$sadds'";

    $sql = "SELECT * FROM `supplier` JOIN `user` WHERE `supplier`.`user_id`=`user`.`id` AND `supplier`.`address`='$sadds' 
    AND `user`.`name`='$sname'  OR `user`.`email`='$semail' OR `user`.`mobile`='$smob'";


    if (mysqli_num_rows(mysqli_query($conn, $sql)) <= 0) {
        $sql_ins = "INSERT INTO `user` (`name`,`mobile`,`email`) VALUES ('$sname','$smob','$semail')";
        if (mysqli_query($conn, $sql_ins)) {
            $uid = mysqli_insert_id($conn);
            // echo $uid;
            $sql_inst = "INSERT INTO `supplier`(`user_id`, `address`) VALUES ('$uid','$sadds')";
            if (mysqli_query($conn, $sql_inst)) {
                $_SESSION['msg'] = "Supplier Added!";
                echo "<script>window.location.href='add_supplier.php' </script>";
            } else {
                // executeQuery($conn, "DELETE FROM `user` WHERE `id` = $userid");
                $_SESSION['msg'] = mysqli_error($conn);
            }
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
            echo "<script>window.location.href='add_supplier.php' </script>";
        }
    } else {
        echo "<script>window.location.href='add_supplier.php' </script>";
        $_SESSION['msg'] = "Supplier Exists!";
    }
}

?>