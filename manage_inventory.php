<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h4 class="alert alert-primary text-center">Manage Inventory</h4>
    <button class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#addinventory">Add Inventory</button>
    <div class="container">
        <table class="table table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
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
<?php require_once 'menu/footer.php' ?>

<?php
if (isset($_POST['addInventory'])) {
    $product = $_POST['product'];
    $qty = $_POST['qty'];
    $bprice = $_POST['bprice'];
    $sprice = $_POST['sprice'];
}
?>