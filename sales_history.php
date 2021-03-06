<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
    <h1 class="mt-4">Sales Records</h1>
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Sales History
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Invoice Number</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `name`, `bill_id`, `total_amount`, `date` FROM `bill` JOIN `user` ON `bill`.`customer_id`=`user`.`id`";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {

                            if (mysqli_num_rows($res) > 0) {
                                $sl = 0;
                                while ($data = mysqli_fetch_assoc($res)) {
                                    ++$sl;
                                    $cname = $data['name'];
                                    $bill_no = $data['bill_id'];
                                    $amount = $data['total_amount'];

                                    $datetime = $data['date'];
                                    $time = date('d-M-Y h:i A', strtotime($datetime));
                        ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $cname ?></td>
                                        <td><?= $bill_no ?></td>
                                        <td><?= "???" . number_format($amount, 2) ?></td>
                                        <td><?= $time ?></td>
                                        <td>
                                            <a href="view_bill.php?inv_id=<?= $bill_no ?>" class="btn btn-sm btn-danger">View</a>
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
    </div>
</div>
<br>
<?php require_once 'menu/footer.php' ?>