<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
<h3 class="text-center bg-dark text-white p-2">List of Products</h3>
    
    <div class="container">
        <table class="table table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items</th>
                    <th scope="col">Category</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `products` JOIN `category` WHERE `products`.`pid`=`category`.`cid`";
                $res = mysqli_query($conn, $sql);
                if ($res) {

                    if (mysqli_num_rows($res) > 0) {
                        $sl =0;
                        while ($data = mysqli_fetch_assoc($res)) {
                            ++$sl;
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
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </td>
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
<br>
<?php require_once 'menu/footer.php' ?>