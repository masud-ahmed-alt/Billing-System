<?php require_once 'menu/header.php' ?>
<div class="container-fluid">

    <h1 class="mt-4">Supplier</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">List of Suppliers</li>
    </ol>

    <div class="card-body">
        <table id="datatablesSimple" class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th class="col-2" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `user` JOIN `supplier` WHERE `user`.`id`=`supplier`.`user_id` ORDER BY `name`";
                $res = mysqli_query($conn, $sql);

                if ($res) {
                    if (mysqli_num_rows($res) > 0) {
                        $sl = 0;
                        while ($data = mysqli_fetch_assoc($res)) {
                            ++$sl;
                            $user_id = $data['user_id'];
                            $name = $data['name'];
                ?>
                            <tr>
                                <th scope="row"><?= $sl ?></th>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><?= $data['mobile'] ?></td>
                                <td><?= $data['address'] ?></td>
                                <td>
                                    <a href="#del_<?= $user_id ?>" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                                    <a href="update_supplier.php?user_id=<?= $user_id ?>" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                            <!-- Modal For  Delete Suppliers-->
                            <div class="modal fade" tabindex="-1" role="dialog" id="del_<?= $user_id ?>" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure to delete <?= $name ?> ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="actions/delete_actions.php" method="post">
                                                <input type="text" name="user_id" value="<?= $user_id ?>" hidden>
                                                <button type="submit" class="btn btn-danger" name="delete_suppliers">Confirm</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    } else {
                        $_SESSION['msg'] = "No data found";
                    }
                } else {
                    $_SESSION['msg'] = mysqli_error($conn);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once 'menu/footer.php' ?>