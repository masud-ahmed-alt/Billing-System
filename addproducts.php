<?php 
require_once 'menu/header.php' 
?>
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4 p-2 card">
            <h4 class="alert alert-primary text-center">Add Product</h4>
        <form action="" method="post">
            <label for="pname" class="text-danger">Product Name *</label>
            <input class="form-control form-control-sm" type="text" name="pname" placeholder="Product Name" required>

            <label for="pcat" class="text-danger">Select Category *</label>
            <select class="form-control form-control-sm" name="category" id="category">
                <option>Select Category</option>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM `category`");
                while ($arr = mysqli_fetch_assoc($res)) {
                    echo "<option value='" . $arr['cid'] . "'>" . $arr['ctitle'] . "</option>";
                }
                ?>
            </select>
            <label for="pname" class="text-danger">Description *</label>
            <input class="form-control form-control-sm" type="text" name="desc" placeholder="Description" required>

            <br>
            <button class="btn btn-primary btn-block" name="addproduct">Add Product</button>

            <?php 
                if(isset($_SESSION['msg'])){
                    echo "<p class='text-center text-danger mt-4'>".$_SESSION['msg']."</p>";
                    unset($_SESSION['msg']);
                }
                ?>
        </form>
        </div>
        </div>  
    </div>
</div>

<?php require_once 'menu/footer.php' ?>


<?php

if (isset($_POST['addproduct'])) {
    $pname = $_POST['pname'];
    $pcat = $_POST['category'];
    $pdesc = $_POST['desc'];

    $getsql = "SELECT * FROM `products` WHERE `pname` = '$pname' AND `description` = '$pdesc'";

    if (mysqli_num_rows(mysqli_query($conn, $getsql)) <= 0) {
        $sql = "INSERT INTO `products`(`pname`, `pcat`, `description`) VALUES ('$pname','$pcat','$pdesc')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['msg'] = "Product Added!";
            echo "<script>window.location.href = 'addproducts.php';</script>";
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
            echo "<script>window.location.href = 'addproducts.php';</script>";
        }
    } else {
        $_SESSION['msg'] = "Product already exists!";
        echo "<script>window.location.href = 'addproducts.php';</script>";
    }
}

?>