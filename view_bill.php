<?php
require_once "lib/db.php";
if (isset($_GET['inv_id'])) {
    $inv_id = $_GET['inv_id'];
    $resp = [];

    $sql = "SELECT `sp`.`bill_id`, `bill`.`total_amount`, `bill`.`total_gst`,
     `sp`.`product_id`,`sp`.`desc`,`sp`.`sell_price`,`user`.`id` as `user_id`, 
     `user`.`name` as `user_name`,`user`.`email`,`user`.`mobile`,`emp`.`id` as `emp_id`, 
     `products`.`pname`,`sp`.`qnt`,
     `bill`.`date` FROM `bill` JOIN `sell_product` as `sp`
      ON `sp`.`bill_id`=`bill`.`bill_id` JOIN `user` ON `user`.`id`=`bill`.`customer_id`
      JOIN `products` ON `sp`.`product_id`= `products`.`pid` 
      JOIN `employe` as `emp` ON `emp`.`id`=`bill`.`emp_id` WHERE `sp`.`bill_id`='$inv_id'";

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($resp, $row);
    }
    $data = mysqli_fetch_array($result);
    $file_name = $resp[0]['user_name'] . "_bill_id" . $inv_id;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title><?= $file_name ?></title>

    <style>
        body {
            background-color: #000
        }

        .padding {
            padding: 2rem !important
        }

        .card {
            /* margin-bottom: 30px; */
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2
        }

        h3 {
            font-size: 20px
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium'
        }

        .text-dark {
            color: #3d405c !important
        }
    </style>
</head>

<body>

    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
            <div class="card main" id="mainWindow">
                <div class="card-header p-4">
                    <div class="float-left">
                        <h2 class="mb-0 text-dark">Billing Management System</h2>
                        <h6 class="mb-0 text-dark">Girijananda Chowdhury Institute of Management & Technology</h6>
                    </div>
                    <div class="float-right">
                        <h3 class="mb-0">Invoice <strong>#<?= $inv_id ?></strong></h3>
                        <?= date_format(date_create($resp[0]['date']), 'd-M-Y h:i A') ?>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="mb-3">To:</h3>
                            <h3 class="text-dark mb-1"><?= $resp[0]['user_name'] ?></h3>
                            <div><?= $resp[0]['email'] ?></div>
                            <div>Phone: <?= $resp[0]['mobile'] ?></div>
                            <div>Saller: <?= $resp[0]['emp_id'] ?></div>
                        </div>

                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th class="right">Price</th>
                                    <th class="center">Qty</th>
                                    <th class="right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sl = 0;
                                foreach ($resp as $res) {

                                ?>
                                    <tr>
                                        <td class="center"><?=++$sl?></td>
                                        <td class="left strong"><?= $res['pname'] ?></td>
                                        <td class="left"><?= $res['desc'] ?></td>
                                        <td class="right"><?= "₹".number_format($res['sell_price'],2 ) ?></td>
                                        <td class="center"><?= $res['qnt'] ?></td>
                                        <td class="right"><?= "₹".number_format(($res['sell_price'] * $res['qnt']),2) ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                            <p class="mt-5 pl-3">This is a computer generated bill.</p>
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Subtotal</strong>
                                        </td>
                                        <td class="right"><?= "₹".number_format(($resp[0]['total_amount']),2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">GST (18%)</strong>
                                        </td>
                                        <td class="right"><?= "₹".number_format(($resp[0]['total_gst']),2) ?></td>
                                    </tr>

                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Grand Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong class="text-dark"><?= "₹".number_format(($resp[0]['total_amount'] + $resp[0]['total_gst']),2) ?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                   

                </div>
            </div>
        <div class="card m-0 pb-4">
            <div class="row ml-5 justify-content-center">
                <div class="float-right pl-5">
                    <button class="btn btn-info" id="printBtn">Print</button>
                </div>
                <div class="float-right pl-5">
                    <button class="btn btn-info" id="savePdf">Save PDF</button>
                </div>

                <div class="float-right pl-5">
                    <a href="generate_bills.php" class="btn btn-info" id="">Dashboard</a>
                </div>
            </div>

        </div>
    </div>


</body>
<script>
    // const doc = new jsPDF();
    let pbtn = document.getElementById("printBtn");
    let pdfbtn = document.getElementById("savePdf");
    var printContents = document.getElementById("mainWindow").innerHTML;
    var originalContents = document.body.innerHTML;
    pbtn.onclick = function() {
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    pdfbtn.onclick = function() {
        const doc = new jsPDF();
        document.body.innerHTML = printContents;
        var opt = {filename: '<?=$file_name?>', margin : 1};
        var worker = html2pdf().set(opt).from(printContents).save();
        document.body.innerHTML = originalContents;
    }
</script>

</html>