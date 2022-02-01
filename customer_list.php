<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h1 class="mt-4">Customers</h1>
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Customer List
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `user` WHERE `email` IS NULL";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {

                            if (mysqli_num_rows($res) > 0) {
                                $sl = 0;
                                while ($data = mysqli_fetch_assoc($res)) {
                                    ++$sl;
                                    $cid = $data['id'];
                                    $cname = $data['name'];
                                    $phone = $data['mobile'];

                        ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $cname ?></td>
                                        <td><?= $phone ?></td>
                                    </tr>

                                  
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
    </div>
</div>
<br>
<?php require_once 'menu/footer.php' ?>