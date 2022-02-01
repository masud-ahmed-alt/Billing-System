<?php require_once 'menu/header.php' ?>
<script src="assets/js/Chart.js">
</script>
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>

    <!-- First rows of cards  -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Products</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT * FROM  `products`";
                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                        ?>
                    </h1>
                    <a class="small text-white stretched-link" href="list_products.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Sales</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT * FROM  `bill`";
                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                        ?>
                    </h1>
                    <a class="small text-white stretched-link" href="sales_history.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Categories</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT * FROM  `category`";
                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                        ?>
                    </h1>
                    <a class="small text-white stretched-link" href="manage_category.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body">Supplies</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT * FROM  `inv_supplier`";
                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                        ?>
                    </h1>
                    <a class="small text-white stretched-link" href="supply_history.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second rows of Cards  -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><strong>Gross Sale</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT SUM(`total_amount`) as `sell_total`, SUM(`total_gst`) as `gst_total` FROM `bill`";
                        $data =  mysqli_fetch_array(mysqli_query($conn, $sql));
                        echo "₹ " . number_format($data[0], 2);
                        ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><strong>Gross GST</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT SUM(`total_amount`) as `sell_total`, SUM(`total_gst`) as `gst_total` FROM `bill`";
                        $data =  mysqli_fetch_array(mysqli_query($conn, $sql));
                        echo "₹ " . number_format($data[1], 2);
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body"><strong>Overal Profit</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <h1 class="text-white">
                        <?php
                        $sql = "SELECT  SUM(`buy_price`*`qnt`) as `bprice`, SUM(`sell_price`*`qnt`) as `sprice` FROM `sell_product`";
                        $data =  mysqli_fetch_array(mysqli_query($conn, $sql));
                        $bprice = $data[0];
                        $sprice = $data[1];

                        $profit = $sprice-$bprice;
                        echo "₹ " . number_format($profit, 2);
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-6">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Daily Profit Chart!
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <script src="assets/js/chart-area-demo.js"></script>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Sale and Buy Price Ratio per months!
                </div>
                <div class="card-body"><canvas id="profit_barChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
    <script src="assets/js/chart-bar-demo.js"></script>
</div>
<?php require_once 'menu/footer.php' ?>
