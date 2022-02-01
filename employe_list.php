<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h1 class="mt-4">Employee</h1>

    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Employee List
            </div>

            <div class="card-body">
                <table id="datatablesSimple" class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM `employe` JOIN `user` ON `employe`.`user_id` = `user`.`id` ORDER BY `username`";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            if (mysqli_num_rows($res) > 0) {
                                $sl = 0;
                                while ($data = mysqli_fetch_assoc($res)) {
                                    ++$sl;
                        ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['mobile'] ?></td>
                                        <td><?= $data['address'] ?></td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once 'menu/footer.php' ?>