<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h4 class="alert alert-primary text-center">Manage Inventory</h4>
    <button class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#addinventory">Add Inventory</button>
    <div class="container">
        <table class="table table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Qty Availabe</th>
                    <th scope="col">Buy Price</th>
                    <th scope="col">Sell Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $sql = "SELECT * FROM `products` JOIN `inventory` ON `products`.`pid`=`inventory`.`pid` ORDER BY `pname`";

                    $res = mysqli_query($conn, $sql);

                    if ($res) {
                        if (mysqli_num_rows($res) > 0) {
                            $sl = 0;
                            while ($data = mysqli_fetch_assoc($res)) {
                                ++$sl;
                                $bprice=$data['buy_price'];
                                $sprice=$data['sell_price'];
                    ?>
                <tr>
                    <th scope="row"><?= $sl ?></th>
                    <td><?= $data['pname'] ?></td>
                    <td><?= $data['description'] ?></td>
                    <td><?= $data['qnt_in_hand'] ?></td>
                    <td><?= "₹" . number_format($bprice, 2) ?></td>
                    <td><?= "₹" . number_format($sprice, 2) ?></td>
                </tr>
    <?php
                            }
                        } else {
                            $_SESSION['msg'] = "No data found";
                        }
                    } else {
                        $_SESSION['msg'] = mysqli_error($conn);
                    }
    ?>
    </tr>

            </tbody>
        </table>
    </div>


    <!-- Modal for add inventory  -->
    <div class="modal fade" id="addinventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Add Inventory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="pcat" class="text-danger">Select Product *</label>
                        <select class="form-control form-control-sm" name="product" id="product">
                            <option>Select Product</option>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM `products`");
                            while ($arr = mysqli_fetch_assoc($res)) {
                                echo "<option value='" . $arr['pid'] . "'>" . $arr['pname'] . "</option>";
                            }
                            ?>
                        </select>

                        <label for="pcat" class="text-danger">Select Supplier *</label>
                        <select class="form-control form-control-sm" name="supplier" id="supplier">
                            <option>Select Supplier</option>
                            <option> Add new supplier</option>
                            <?php
                            $res = mysqli_query($conn, "SELECT `supplier`.`id`,`user`.`name` FROM `supplier` JOIN `user` ON `user`.`id`=`supplier`.`user_id`");
                            while ($arr = mysqli_fetch_assoc($res)) {
                                echo "<option value='" . $arr['id'] . "'>" . $arr['name'] . "</option>";
                            }
                            ?>
                        </select>


                        <label for="qty" class="text-danger">Quantity *</label>
                        <input class="form-control form-control-sm" type="text" name="qty" placeholder="Quantity" required>

                        <label for="bprice" class="text-danger">Buy Price *</label>
                        <input class="form-control form-control-sm" type="text" name="bprice" placeholder="Eg- 20.00" required>

                        <label for="sprice" class="text-danger">Sell Price *</label>
                        <input class="form-control form-control-sm" type="text" name="sprice" placeholder="Eg- 22.00" required>

                        <br>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-sm btn-success" name="addInventory">Add Inventory</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<?php
require_once 'menu/footer.php';
require_once './functions.php';

if (isset($_POST['addInventory'])) {
    $product = $_POST['product'];
    $supplier = $_POST['supplier'];
    $qty = $_POST['qty'];
    $bprice = $_POST['bprice'];
    $sprice = $_POST['sprice'];

    $count_sql = "SELECT * FROM `inventory` WHERE `pid` = '$product'";

    // inventory


    if (countRow($conn, "inventory", "`pid` = '$product'") <= 0) {

        $sql = "INSERT INTO `inventory` (`pid`,`qnt_in_hand`,`sell_price`,`buy_price`) VALUES ('$product','$qty','$sprice','$bprice')";
        if (mysqli_query($conn, $sql)) {
            $inv_id = mysqli_insert_id($conn);
            $sql_inv_s = "INSERT INTO `inv_supplier` (`supplier`,`inv_id`,`qnt`) VALUES ('$supplier','$inv_id','$qty')";
            if (mysqli_query($conn, $sql_inv_s)) {
                $_SESSION['msg'] = "RECORD SAVED";
            } else {
                $_SESSION['msg'] = mysqli_error($conn);
            }
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
        }
    } else {
        $result = mysqli_query($conn, "SELECT * FROM `inventory` WHERE `pid`='$product'");
        $data = mysqli_fetch_assoc($result);
        $qnt_in_hand = $data['qnt_in_hand'];
        $inv_id = $data['iid'];
        $qty_total = (int)$qnt_in_hand + (int)$qty;


        if (mysqli_query($conn, "UPDATE `inventory` SET `qnt_in_hand`='$qty_total', `buy_price`='$bprice', `sell_price`='$sprice' WHERE `pid`='$product'")) {
            $sql_invs = "INSERT INTO `inv_supplier` (`inv_id`, `supplier`, `qnt`) VALUES ('$inv_id', '$supplier','$qty')";
            if (mysqli_query($conn, $sql_invs)) {
                $_SESSION['msg'] = "RECORD SAVED";
            } else {
                $_SESSION['msg'] = mysqli_error($conn);
            }
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
        }
    }
    echo "<script>window.location.href='manage_inventory.php' </script>";
}
?>

</script>