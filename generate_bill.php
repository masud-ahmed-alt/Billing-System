<?php require_once "lib/db.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}

require_once "ajax/crud.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS
    <link href="assets/css/dataTables.bootstrap.min.css"> -->



    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/datatables.min.css">

    <!-- JQUERY -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->


    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>



    <!-- <link href="assets/css/all.min.css" rel="stylesheet"> -->

    <title>Generate Bill</title>
</head>

<body>
    <div class="container-fluid">
        <div class="conatiner-fluid">
            <div class="container-fluid bg-dark text-center rounded">
                <h2 class="text-white "> Billing Management System </h2>
                <div class="row text-center">
                    <div class="col-sm">
                        <a href="index.php" class="btn btn-warning btn-sm text-white">DASHBOARD</a>
                    </div>
                    <div class="col-sm">
                        <p class="text-white" id=""><span id="date" style="font-weight: bolder;">Date</span></p>
                        </span></h6>
                    </div>
                    <div class="col-sm">
                        <p class="text-white"><span id="time" style="font-weight: bolder;">time</span></p>
                    </div>
                    <div class="col-sm ">
                        <span>
                            <h6 class="text-white border border-white">Hello <span id="ename" style="font-weight: bold;">
                                    <?php
                                    // show current employee 
                                    if (isset($_SESSION['user'])) {
                                        // print_r($_SESSION['user']);
                                        $id = $_SESSION['user']['user_id'];
                                        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE `id`='$id'"));
                                        echo $data['name'];
                                    }
                                    ?>

                                </span>!
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-1">
            <div class="row">
                <div class="col-3">
                    <div class="container-fluid p-2">
                        <h4 class="text-center bg-success text-light rounded">Products</h4>

                        <div class="table-responsive">

                            <table class="table text-center" id="table_filter">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Desc</th>
                                        <th>Price</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT `products`.`pid`,`products`.`pname`, `products`.`description`, `inventory`.`sell_price` FROM `products` JOIN `inventory` ON `inventory`.`pid`=`products`.`pid`";
                                    $res = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($res)) {


                                    ?>
                                        <tr>
                                            <td><?= $row['pname'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><?= $row['sell_price'] ?></td>
                                            <td>

                                                <input type="hidden" name="pid" value="<?= $row['pid'] ?>">
                                                <button type="button" onclick="selectProduct(<?= $row['pid'] ?>)" class="btn btn-sm btn-primary"> > </button>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="container-fluid p-2">
                        <h3 class="text-center bg-success text-light">INVOICE</h3>
                        <!-- Customer Info -->
                        <form>
                            <div class="form-group-sm row">
                                <div class="col-3">
                                    <input type="search" class="form-control form-control-sm" id="" placeholder="Customer Contact" aria-label="Search" aria-describedby="search-addon">
                                </div>
                                <div class="col-3   ">
                                    <input type="text" class="form-control  form-control-sm" id="" placeholder="Customer Name">
                                </div>
                            </div>

                        </form>
                    </div>


                    <div class="container-fluid p-2">
                        <h4 class="border-bottom">Bill</h4>

                        <table class="table table-sm table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="col-3">Items</th>
                                    <th scope="col" class="col-3">Desc</th>
                                    <th scope="col">Qtty</th>
                                    <th scope="col">Price(₹)</th>
                                    <th scope="col">Total(₹)</th>
                                    <th scope="col">-</th>
                                </tr>
                            </thead>
                            <tbody id="bill_items">
                                <tr>
                                    <th>1</th>
                                    <td>Coconut Oil</td>
                                    <td>100 ML Bottle</td>
                                    <td>5</td>
                                    <td>50.00</td>
                                    <td>250.00</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger">-</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td class="text-right text-dark">
                                        <h5><strong>Sub Total: ₹ </strong></h5>
                                        <p><strong>GST (18%) : ₹ </strong></p>
                                    </td>
                                    <td class="text-center text-dark">
                                        <h5> <strong><span id="subTotal">250.00</strong></h5>
                                        <h5> <strong><span id="taxAmount">45.00</strong></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>

                                    <td class="text-right text-dark">
                                        <h5><strong>Gross Total: ₹ </strong></h5>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h5 id="totalPayment"><strong>295.00</strong></h5>
                                    </td>
                                    <td class="text-center text-danger">
                                        <button class="btn btn-primary col-5">CONFIRM</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>





        <script>
            window.onload = displayClock();
            let products = [];

            function displayClock() {
                var time = new Date().toLocaleTimeString();
                document.getElementById('time').innerHTML = time;
                setTimeout(displayClock, 1000);


                var date = new Date().toDateString();
                document.getElementById('date').innerHTML = date;
            }

            $(document).ready(function() {
                $('#table_filter').DataTable();
            });



            function selectProduct(id) {
                // console.log(id);
                mySessionId = "<?php echo session_id(); ?>";
                localStorage.setItem(mySessionId, id)
                products.push(id);
                updateBillItems();
            }

            function callAjax(id) {
                fetch()
                    .then(() => {

                    }).catch(() => {

                    })
            }

            function updateBillItems() {
                let up_pr = [];
                for (let i = 0; i < products.length; i++) {
                    console.log(products[i]);
                    callAjax(products[i]);
                }
            }
        </script>
</body>

</html>