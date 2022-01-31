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
                        $sl=0;
                        while ($data = mysqli_fetch_assoc($res)) {
                            ++$sl;
                ?>
                            <tr>
                                <th scope="row"><?=$sl?></th>
                                <td><?=$data['name']?></td>
                                <td><?=$data['email']?></td>
                                <td><?=$data['mobile']?></td>
                                <td><?=$data['address']?></td>
                                <td>
                                    <button class="btn-sm btn-primary">Edit</button>
                                    <button class="btn-sm btn-danger">Delete</button>
                                </td>
                                
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
<?php require_once 'menu/footer.php' ?>