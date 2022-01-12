<?php include_once "menu/header.php"; ?>
<br>
<h3 class="alert alert-primary text-center">Category</h3>

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
            <div class="row">
                <table class="table table-center table-sm">
                <thead class="thead-dark">
                            <tr class="trstick">
                                <th scope="col">Sl No</th>
                                <th scope="col">Category Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                </table>
                <div class="col overflow-auto" style="max-height: 60vh;">
                    <table class="table text-center table-sm">
                        <?php
                        $sql = "SELECT * FROM `category` ORDER BY `ctitle`";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = mysqli_num_rows($res);
                            $sl = 0;
                            if ($count > 0) {
                                while ($data = mysqli_fetch_assoc($res)) {
                                    $cat_id = $data['cid'];
                                    $cat_title = $data['ctitle'];
                                    $sl++;

                        ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $sl; ?></th>
                                            <td><?= $cat_title; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#update_<?= $cat_id ?>" class="btn btn-primary btn-sm" data-toggle="modal" id="">Edit</a>
                                                    <a href="#del_<?= $cat_id ?>" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                                                </div>
                                            </td>

                                        </tr>

                                    </tbody>

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
                                                    <form action="actions/delete-action.php" method="post">
                                                        <input type="text" name="cat_id" value="<?= $cat_id ?>" hidden>
                                                        <button type="submit" class="btn btn-danger" name="delete_btn">Confirm</button>
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

                                                    $sql = "SELECT * FROM `category` WHERE `cid`='$cat_id'";

                                                    if (mysqli_num_rows(mysqli_query($conn, $sql)) == 1) {
                                                        $data = mysqli_fetch_assoc(mysqli_query($conn, $sql));

                                                    ?>
                                                        <form action="actions/edit_action.php" method="post">
                                                            <div class="form-group">
                                                                <label for="title" class="text-danger">Category Title*</label>
                                                                <input type="hidden" class="form-control" id="" name="cid" value="<?= $data['cat_id'] ?>">
                                                                <input type="text" class="form-control" id="" name="ctitle" value="<?= $data['cat_title'] ?>">

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
                                echo "No data available";
                            }
                        } else {
                            echo mysqli_error($conn);
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

</script>

<?php include_once "menu/footer.php"; ?>