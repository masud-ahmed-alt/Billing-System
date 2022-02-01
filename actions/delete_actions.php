<?php

require_once '../lib/db.php';


// Category delete 
if (isset($_POST['delete_cat'])) {
    $id = $_POST['cat_id'];

    $sql = "DELETE FROM `category` WHERE `cid` = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Category Deleted!');window.location.href = '../manage_category.php';</script>";
    } else {
        echo "<script>alert('Something wents wrong!');window.location.href = '../manage_category.php';</script>";
    }
}

// delete product 
else if (isset($_POST['delete_product'])) {
    $id = $_POST['pid'];

    $sql = "DELETE FROM `products` WHERE `pid` = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product Deleted!');window.location.href = '../list_products.php';</script>";
    } else {
        echo "<script>alert('Something wents wrong!');window.location.href = '../list_products.php';</script>";
    }
}

// delete supplier 
else if (isset($_POST['delete_suppliers'])) {
    $id = $_POST['user_id'];

    $sql = "DELETE FROM `user` WHERE `id` = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Supplier Deleted!');window.location.href = '../list_suppliers.php';</script>";
    } else {
        echo "<script>alert('Something wents wrong!');window.location.href = '../list_suppliers.php';</script>";
    }
}

