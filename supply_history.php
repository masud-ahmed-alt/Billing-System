<?php require_once 'menu/header.php' ?>
<div class="container-fluid">
<h1 class="mt-4">Inventory</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Supply History</li>
    </ol>


    <div class="container">
        <table class="table table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Items</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Buy Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date & Time</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT `products`.`pid`,`products`.`pname`,`products`.`description`,`supplier`.`id` 
                as `sid`,`user`.`name`,`inventory`.`buy_price`,`inventory`.`sell_price`,`inv_supplier`.`date`, `inv_supplier`.`qnt` 
                FROM `products` JOIN `inventory` ON `products`.`pid`=`inventory`.`pid` 
                JOIN `inv_supplier` ON `inventory`.`iid`=`inv_supplier`.`inv_id` 
                JOIN `supplier` ON `inv_supplier`.`supplier`=`supplier`.`id` 
                JOIN `user` ON `user`.`id`=`supplier`.`user_id` ORDER BY `date`";

                $res = mysqli_query($conn, $sql);

                if ($res) {
                    if (mysqli_num_rows($res) > 0) {
                        $sl=0;
                        while ($data = mysqli_fetch_assoc($res)) {
                            ++$sl;

                            $bprice = $data['buy_price'];
                            $qtn = $data['qnt'];
                            $amount = (int)$bprice * (int)$qtn;
                            $datetime=$data['date'];
                            $time = date('d-M-Y h:i A', strtotime($datetime));
                ?>
                            <tr>
                                <th scope="row"><?=$sl?></th>
                                <td><?=$data['pname']?></td>
                                <td><?=$data['description']?></td>
                                <td><?=$data['name']?></td>
                                <td><?="₹".number_format($bprice,2)?></td>
                                <td><?=$data['qnt']?></td>
                                <td><?="₹".number_format($amount,2)?></td>
                                <td><?=$time?></td>
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