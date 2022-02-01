<?php
require_once 'menu/header.php'
?>

<div class="container-fluid">
<h1 class="mt-4">Update Product</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4 p-2 card">
                <!-- <h4 class="alert alert-primary text-center">Update Product</h4> -->
                <?php
                $pid = $_GET['pid'];
                $getsql = "SELECT * FROM `products` WHERE `pid` = '$pid'";
                $data = mysqli_fetch_assoc(mysqli_query($conn, $getsql));
                ?>

                <form action="actions/edit_actions.php" method="post">
                    <!-- <label for="pname" class="text-danger">Product Id *</label> -->
                    <input class="form-control form-control-sm" type="hidden" name="pid" value="<?= $data['pid'] ?>" required>
                    <label for="pname" class="text-danger">Product Name *</label>
                    <input class="form-control form-control-sm" type="text" name="pname" value="<?= $data['pname'] ?>" required>

                    <label for="pcat" class="text-danger">Select Category *</label>
                    <select class="form-control form-control-sm" name="category" id="category">
                        <option>Select Category</option>

                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM `category`");
                        while ($arr = mysqli_fetch_assoc($res)) {

                        ?>
                            <option value="<?= $arr['cid'] ?>" <?= ($data['pcat'] == $arr['cid']) ? "selected" : "" ?>><?= $arr['ctitle'] ?></option>
                        <?php } ?>




                    </select>
                    <label for="pname" class="text-danger">Description *</label>
                    <input class="form-control form-control-sm" type="text" name="desc" value="<?= $data['description'] ?>" required>

                    <br>
                    <button class="btn btn-primary btn-block" name="updtproduct">Update Product</button>
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