<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
<h1 class="mt-4">Product List</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">List Of Products</li>
    </ol>
    
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
                $sql = "SELECT * FROM `products` JOIN `category` ON `products`.`pcat`=`category`.`cid`";
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