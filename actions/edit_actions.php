<?php
require_once '../lib/db.php';

if(isset($_POST['updateCat'])){
    $id = $_POST['cid'];
    $ctitle = $_POST['ctitle'];

    $sqlget = "SELECT * FROM `category` WHERE `cid`='$id'";

    if(mysqli_num_rows(mysqli_query($conn, $sqlget))==1){
        $sql = "UPDATE `category` SET `ctitle`='$ctitle' WHERE `cid`='$id'";

        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Category Updated!');window.location.href = '../manage_category.php';</script>";
        }else{
            echo "<script>alert('Something wents wrong!');window.location.href = '../manage_category.php';</script>";
        }
    }
}