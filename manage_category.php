<?php include_once "menu/header.php"; ?>

<div class="container-fluid">
    <h1 class="mt-4">Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Manage Category</li>
    </ol>

    <div class="container">
        <div class="parent-container d-flex">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" id="" name="cat_title" placeholder="Category Title" required>
                                <div class="input-group-append">
                                    <input type="submit" class="btn btn-outline-success" name="addcat" value="Add Category">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <br><br>
            </div>
            <?php

            if (isset($_POST['addcat'])) {
                $title = $_POST['cat_title'];
                $getsql = "SELECT * FROM `category` WHERE `ctitle` = '$title' ";
                $postsql = "INSERT INTO `category`(`ctitle`) VALUES ('$title')";

                if (mysqli_num_rows(mysqli_query($conn, $getsql)) <= 0) {

                    if (mysqli_query($conn, $postsql)) {
                        echo "<script>window.location.href = 'manage_category.php';</script>";
                    }
                } else {
                    echo "<script>alert('Category already Exists!');window.location.href = 'manage_category.php';</script>";
                }
            }

            ?>

            
            <div class="container">
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-sm">
                        <thead class="thead-dark">
                            <tr class="trstick">
                                <th scope="col">Sl No</th>
                                <th scope="col">Category Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `category` ORDER BY `ctitle`";
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                $sl = 0;
                                while ($data = mysqli_fetch_assoc($res)) {
                                    $cat_id = $data['cid'];
                                    $cat_title = $data['ctitle'];
                            ?>
                                    <tr>
                                        <td><?= ++$sl ?></td>
                                        <td><?= $data['ctitle'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#update_<?= $cat_id ?>" class="btn btn-primary btn-sm" data-target="#update_<?= $cat_id ?>" data-toggle="modal" id="">Edit</a>
                                                <a href="#del_<?= $cat_id ?>" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal For  Delete Category-->
                    <div class="modal fade" tabindex="-1" role="dialog" id="del_<?= $cat_id ?>" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Are you sure to delete <?= $cat_title ?> ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <form action="actions/delete_actions.php" method="post">
                                        <input type="text" name="cat_id" value="<?= $cat_id ?>" hidden>
                                        <button type="submit" class="btn btn-danger" name="delete_cat">Confirm</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal For  Update Category-->
                    <div class="modal fade" id="update_<?= $cat_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <?php

                                    $sqlcat = "SELECT * FROM `category` WHERE `cid`='$cat_id'";

                                    if (mysqli_num_rows(mysqli_query($conn, $sqlcat)) == 1) {
                                        $data = mysqli_fetch_assoc(mysqli_query($conn, $sqlcat));


                                    ?>
                                        <form action="actions/edit_actions.php" method="post">
                                            <div class="form-group">
                                                <label for="title" class="text-danger">Category Title*</label>
                                                <input type="hidden" class="form-control" id="" name="cid" value="<?= $data['cid'] ?>">
                                                <input type="text" class="form-control" id="" name="ctitle" value="<?= $data['ctitle'] ?>">

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                                <button type="submit" name="updateCat" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    <?php
                                    }

                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                            <?php
                                }
                            } else {
                                $_SESSION['msg'] = "No data available";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>



<?php include_once "menu/footer.php"; ?>