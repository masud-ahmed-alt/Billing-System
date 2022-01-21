<?php

require_once '../lib/db.php';


// Category delete 
if (isset($_POST['delete_cat'])) {
    $id = $_POST['cat_id'];

    $sql = "DELETE FROM `category` WHERE `cid` = '$id'";
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Category Deleted!');window.location.href = '../manage_category.php';</script>";
    }else{
        echo "<script>alert('Something wents wrong!');window.location.href = '../manage_category.php';</script>";
    }

    
}
