<?php require_once 'menu/header.php' ?>
<script src="assets/js/datatables-simple-demo.js"></script>
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
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
    <div class="row">
        <div class="col-xl-6">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Sales Per months



                </div>
                <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Example
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40">


                    </canvas></div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Recent Sales
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once 'menu/footer.php' ?>