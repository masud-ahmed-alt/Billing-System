<?php
session_start();
require_once "lib/db.php";

// if (!isset($_SESSION["id"]) && !isset($_SESSION['username'])) {
//     header("location: login.php");
// }
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

    <link href="assets/css/all.min.css" rel="stylesheet">
    <link href="assets/css/table.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/card.css">
    <title>Welcome to Billing Management System</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light h5">
        <h3 class="text-center text-success">
            Billing
        </h3>
        <div class="container-fluid ml-4 mr-4">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sale</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Product
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Add Products</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">List of Products</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Customers
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Add Customers</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">List of Customers</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Suppliers
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Add Supplier</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">List of Supplier</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Supply Products</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_category.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employe_list.php">Employees</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Your Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?action=logout">Logout</a>
                        </div>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container-fluid border">


        <?php
        if (isset($_GET['action'])) {
            if (isset($_GET['action']) == "logout") {
                session_destroy();
                if (isset($_SESSION['user'])) {
                    echo "<script>window.location.href ='login.php';</script>";
                    // header("location:login.php");
                }
            }
        }
        ?>