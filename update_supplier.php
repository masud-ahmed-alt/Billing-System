<?php
require_once 'menu/header.php'
?>

<div class="container-fluid">
    <h1 class="mt-4">Update Suppliers</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4 p-2 card">
                <!-- <h4 class="alert alert-primary text-center">Update Product</h4> -->
                <?php
                $user_id = $_GET['user_id'];
                $getsql = "SELECT * FROM `user` JOIN `supplier` WHERE `user`.`id`=`supplier`.`user_id`  AND `user`.`id`='$user_id'";
                $data = mysqli_fetch_assoc(mysqli_query($conn, $getsql));
                ?>

                <form action="actions/edit_actions.php" method="post">
                    <label for="pname" class="text-danger">Supplier Id *</label>
                    <input class="form-control form-control-sm" type="text" name="supp_id" value="<?= $data['user_id'] ?>" required>

                    <label for="pname" class="text-danger">Supplier Name *</label>
                    <input class="form-control form-control-sm" type="text" name="sname" value="<?= $data['name'] ?>" required>

                    <label for="pname" class="text-danger">Phone *</label>
                    <input class="form-control form-control-sm" type="text" name="smob" value="<?= $data['mobile'] ?>" required>

                    <label for="pname" class="text-danger">Email *</label>
                    <input class="form-control form-control-sm" type="email" name="semail" value="<?= $data['email'] ?>" required>

                    <label for="pname" class="text-danger">Address *</label>
                    <input class="form-control form-control-sm" type="text" name="adds" value="<?= $data['address'] ?>" required>

                    <br>
                    <button class="btn btn-primary btn-block" name="updtsupplier">Update Supplier</button>
                </form>


                <?php
                if (isset($_SESSION['msg'])) {
                    echo "<p class='text-center text-danger mt-4'>" . $_SESSION['msg'] . "</p>";
                    unset($_SESSION['msg']);
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php require_once 'menu/footer.php' ?>