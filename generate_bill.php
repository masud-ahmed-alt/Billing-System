<?php require_once "lib/db.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- JQUERY -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->
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
                                <?php $id = (Integer) $_SESSION['user'];
                                // echo $id;
                                // $ename = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_employee` WHERE `eid`='$id'"))['ename'];
                                ?>
                                <?= (isset($_SESSION['user'])) ? '$ename' : "NA" ?>
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
                        <div class="input-group-sm rounded">
                            <input type="search" class="form-control rounded" placeholder="Search Product" aria-label="Search" aria-describedby="search-addon" />
                        </div>

                        <table class="table table-sm table-bordered text-center">
                            <tbody>
                                <tr>
                                    <td>Coconut Oil</td>
                                    <td>100 ML Bottle</td>
                                    <td>50.00</td>
                                    <td class="btn btn-sm btn-primary"> > </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="container-fluid p-2">
                        <h3 class="text-center bg-success text-light rounded">INVOICE</h3>
                        <!-- Customer Info -->
                        <form>
                            <div class="form-group-sm row">
                                <label for="cont" class="col-sm-1 col-form-label">Contact:</label>
                                <div class="col-5">
                                    <input type="search" class="form-control rounded" id="" placeholder="Customer Contact" aria-label="Search" aria-describedby="search-addon">
                                </div>
                            </div>
                            <div class="form-group-sm row">
                                <label for="name" class="col-sm-1 col-form-label">Name:</label>
                                <div class="col-5">
                                    <input type="text" class="form-control rounded" id="" placeholder="Customer Name">
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
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
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

            function displayClock() {
                var time = new Date().toLocaleTimeString();
                document.getElementById('time').innerHTML = time;
                setTimeout(displayClock, 1000);


                var date = new Date().toDateString();
                document.getElementById('date').innerHTML = date;
            }
        </script>
</body>

</html>