<?php require_once 'menu/header.php' ?>


<?php

$id = $_SESSION['user']['user_id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `employe` JOIN `user` ON `employe`.`user_id` = `user`.`id` WHERE `employe`.`user_id`='$id'"));
$eid = $data['id'];
$name = $data['name'];
$username = $data['username'];
$mobile = $data['mobile'];
$email = $data['email'];
$adds = $data['address'];

?>

<div class="container-fluid">
    <h1 class="mt-4">Profile</h1>

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">

                                <?php
                                $sqlimg = "SELECT `image` FROM `employe` WHERE `user_id` = '$id'";
                                $img = mysqli_fetch_assoc(mysqli_query($conn, $sqlimg));
                                // http://localhost/billingApp/images/1643695708windows-10-uhd-4k-wallpaper.jpg
                                // http://localhost/billingApp/images/1643695592windows-10-uhd-4k-wallpaper.jpg
                                
                                if($img['image']!=null){
                                ?>

                                <img src="images/<?=$img['image']?>" alt="No Image" class="rounded-circle" width="210">
                                <?php
                                }
                                ?>
                                <br>

                                <form action="actions/edit_actions.php" method="post" enctype="multipart/form-data">
                                    <div class="input-group container">
                                        <input type="hidden" name="id" value="<?= $eid ?>">
                                        <input type="file" class="form-control form-control-sm" id="inputGroupFile04" name="image">
                                        <input class="btn btn-sm btn-outline-secondary" name="upldimg" type="submit" id="inputGroupFileAddon04" value="Upload Image">
                                    </div>
                                    <?php
                                    if (isset($_SESSION['img'])) {
                                        echo "<p class='text-center text-danger'>" . $_SESSION['img'] . "</p>";
                                        unset($_SESSION['img']);
                                    }
                                    ?>
                                </form>

                                <div class="mt-3">
                                    <h4><?= $name ?></h4>
                                    <p class="text-secondary mb-1"><?= $username ?></p>
                                    <p class="text-secondary mb-1"><?= $email ?></p>
                                    <p class="text-muted font-size-sm"><?= $adds ?></p>
                                    <p class="text-muted font-size-sm"><?= "+91 " . $mobile ?></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="actions/edit_actions.php" method="post" class="">
                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">

                                    <div class="col-sm-9 text-secondary">
                                        <input type="hidden" class="form-control form-control-sm" name="eid" value="<?= $eid ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control form-control-sm" name="name" value="<?= $name ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>

                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control form-control-sm" name="username" value="<?= $username ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" class="form-control form-control-sm" name="email" value="<?= $email ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control form-control-sm" name="mobile" value="<?= $mobile ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control form-control-sm" name="adds" value="<?= $adds ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" name="updatepro" class="btn btn-sm btn-primary" value="Update">
                                    </div>
                                    <?php
                                    if (isset($_SESSION['msg'])) {
                                        echo "<p class='text-danger'>" . $_SESSION['msg'] . "</p>";
                                        unset($_SESSION['msg']);
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </form>





                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Change Password</h5>

                                    <form action="actions/edit_actions.php" method="post">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row mb-3">

                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="hidden" class="form-control form-control-sm" name="id" value="<?= $id ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Current Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="password" class="form-control form-control-sm" name="curr_pass" placeholder="Current Password" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">New Password</h6>
                                                    </div>

                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control form-control-sm" name="new_pass" placeholder="Enter new password" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Confirm Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="password" name="new_passconn" class="form-control form-control-sm" placeholder="Confirm Password" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <?php

                                                        if (isset($_SESSION['chng'])) {
                                                            echo "<p class='text-danger'>" . $_SESSION['chng'] . "</p>";
                                                            unset($_SESSION['chng']);
                                                        }
                                                        ?>
                                                        <input type="submit" class="btn btn-sm btn-success" name="chngpass" value="Change Password">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'menu/footer.php' ?>