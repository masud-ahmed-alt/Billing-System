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



    </div>
    <div class="container-fluid p-1">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-11">
                <div class="container-fluid p-2">
                    <h4 class="text-center bg-success text-light rounded">Products</h4>
                    <div class="card p-2">
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
            </div>
            <div class="col-md-9 col-xs-12 col-sm-11">
                <form>
                    <div class="container-fluid p-2">
                        <h3 class="text-center bg-success text-light">INVOICE</h3>
                        <!-- Customer Info -->

                        <div class="row">
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="number" class="form-control form-control-sm" id="contact" placeholder="eg .940XXXXXXX1" id="contact" required onkeyup="getUser(this)">
                                </div>

                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <div class="form-group">
                                    <label for="mobile">Name</label>

                                    <input type="text" class="form-control  form-control-sm" id="cust_name" placeholder="Enter Customer Name ..." required>
                                </div>
                            </div>
                        </div>


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
                                <!-- <p class="text-center">No Product Selected</p> -->

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
                                        <h5> <strong><span id="total"></strong></h5>
                                        <h5> <strong><span id="gst"></strong></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>

                                    <td class="text-dark">
                                        
                                    </td>
                                    <td class="text-center">
                                    <h5><strong>Gross Total: <strong id="gross" class="text-danger"></strong></strong></h5>
                                        
                                    </td>
                                    <td class="">
                                        <button type="button" id="final_submit" class="btn btn-primary" onclick="finalSubmit()">CONFIRM</button>
                                        <a href="ajax/products.php?reset_session=<?=session_id()?>" class="btn btn-danger" >RESET</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </form>
            </div>

        </div>
    </div>



    <script>
        window.onload = displayClock();
        let products = [];
        let total_price = 0;
        let total_gst = 0;
        let customer_id = null;
        let emp = "<?= $_SESSION['user']['user_id']; ?>";

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
            callAjax(id, mySessionId);
        }

        function callAjax(id, session_id) {
            let url = "ajax/products.php";
            var data = new FormData();
            data.append('product_id', id);
            data.append('session_id', session_id);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'ajax/products.php', true);
            xhr.onload = function() {
                // console.log(JSON.parse(this.responseText));
                updateUI();

            };
            xhr.send(data);
        }

        function updateUI() {
            mySessionId = "<?php echo session_id(); ?>";
            let url = "ajax/products.php?session_id=" + mySessionId;
            let xrh = new XMLHttpRequest();
            xrh.open('GET', "ajax/products.php?session_id=" + mySessionId, true);
            xrh.onload = function() {
                let prds = JSON.parse(this.responseText);
                updateToList(prds);
            }
            xrh.send();
        }

        function updateToList(product) {
            // console.log(product);
            $('#bill_items').html("");
            let total = 0;
            let gst = 0
            for (let i = 0; i < product.length; i++) {
                total += product[i].qnt * product[i].sell_price;
                let pid = product[i].pid;
                let tr = `
                        <tr>
                            <th>${i+1}</th>
                            <td>${product[i].pname}</td>
                            <td>${product[i].description}</td>
                            <td>${product[i].qnt}</td>
                            <td>${parseFloat(product[i].sell_price).toFixed(2)}</td>
                            <td>${(parseFloat(product[i].qnt)*(product[i].sell_price)).toFixed(2)}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick = "reduceQnt(${pid})">-</button>
                            </td>
                        </tr>
                    
                    `;
                $('#bill_items').append(tr);
            }
            gst = ((18 / 100) * total).toFixed(2);
            let grandTotal = parseFloat(total) + parseFloat(gst);
            $('#total').text(total.toFixed(2));
            $("#gst").text(gst);
            $("#gross").text("₹ " + grandTotal.toFixed(2));
            total_price = total;
            total_gst = gst;


        }

        function reduceQnt(pid) {

            session_id = "<?php echo session_id(); ?>";
            let xrh = new XMLHttpRequest();
            var data = new FormData();
            data.append('pid', pid);
            data.append('sid', session_id);
            xrh.open('POST', "ajax/products.php", true);
            xrh.onload = function() {
                updateUI();
            }
            xrh.send(data);

        }

        $(document).ready(function() {
            updateUI();
        })

        function getUser(data) {
            $('#cust_name').val("")
            let number = data.value;
            if (number.length >= 9) {
                let xrh = new XMLHttpRequest();
                let url = "ajax/products.php?contact=" + number;

                xrh.open('GET', url, true);
                xrh.onload = function() {
                    let data = JSON.parse(this.responseText)
                    if (data.length > 0) {
                        $('#cust_name').val(data[0][1])
                        customer_id = data[0][0];
                    }
                    // console.log(data.length);


                }

                xrh.send();

            }
        }

        function finalSubmit() {
            let emp = "<?= $_SESSION['user']['user_id']; ?>";
            let session_id = "<?php echo session_id(); ?>";
            if (total_price !== 0 && total_gst !== 0) {
                if (customer_id == null) {
                    let contact = document.getElementById("contact").value;
                    let cust_name = document.getElementById("cust_name").value;
                    if (contact.length >= 10 && cust_name.length > 5) {
                        let data = new FormData();
                        data.append('name', cust_name);
                        data.append('mobile', contact)
                        addCustomer(data);


                    } else {
                        alert("Customer Information required!")
                        return;
                    }

                } else {
                    if (customer_id == null) {
                        alert("Customer Required!");
                        return;
                    } else {
                        let xrh = new XMLHttpRequest();
                        let con = new FormData();
                        con.append("finalSubmit", 1);
                        con.append("session_id", session_id);
                        con.append("emp_id", emp);
                        con.append("customer", customer_id);
                        con.append("total_amount", total_price);
                        con.append("total_gst", total_gst);
                        xrh.open('POST', "ajax/products.php", true);
                        xrh.onload = function() {
                            //  console.log(this.responseText);
                            let d = JSON.parse(this.responseText);
                            if (d.success) {
                                alert("Bill Generated with id : " + d.bill_id);
                                forward(d.bill_id);
                            }
                        }
                        xrh.send(con);
                    }
                }



            } else {
                alert("Add minimum 1 product....");
            }
        }

        function forward(bill_id) {
            window.location.href = "view_bill.php?inv_id=" + bill_id;
        }

        function addCustomer(data) {

            let xrh = new XMLHttpRequest();
            xrh.open('POST', "ajax/products.php", true);
            xrh.onload = function() {
                let resp = JSON.parse(this.responseText);
                customer_id = resp.id;
                // console.log(resp);
                // if (resp.success) {
                //     return resp.id;
                // } else {
                //    return  null;
                // }
            }
            xrh.send(data);
            return false;
        }
    </script>
</body>

</html>