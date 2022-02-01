<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h1 class="mt-4">Product List</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">List Of Products</li>
    </ol>

    <div class="card-body">
        <table id="datatablesSimple" class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Category</th>
                    <th class="col-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `products` JOIN `category` ON `products`.`pcat`=`category`.`cid`";
                $res = mysqli_query($conn, $sql);
                if ($res) {

                    if (mysqli_num_rows($res) > 0) {
                        $sl = 0;
                        while ($data = mysqli_fetch_assoc($res)) {
                            ++$sl;
                            $pid = $data['pid'];
                            $pname = $data['pname'];
                            $desc = $data['description'];
                            $pcat = $data['ctitle'];
                ?>
                            <tr>
                                <th scope="row"><?= $sl ?></th>
                                <td><?= $pname ?></td>
                                <td><?= $desc ?></td>
                                <td><?= $pcat ?></td>
                                <td>
                                    <a href="#del_<?= $pid ?>" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                                    <a href="update_product.php?pid=<?= $pid ?>" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>


                            <!-- Modal For  Delete Product-->
                            <div class="modal fade" tabindex="-1" role="dialog" id="del_<?= $pid ?>" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure to delete <?= $pname ?> ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="actions/delete_actions.php" method="post">
                                                <input type="text" name="pid" value="<?= $pid ?>" hidden>
                                                <button type="submit" class="btn btn-danger" name="delete_product">Confirm</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                <?php
                        }
                    } else {
                        $_SESSION['msg'] = "No Data Available";
                    }
                } else {
                    $_SESSION['msg'] = mysqli_error($conn);
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<br>
<?php require_once 'menu/footer.php' ?>