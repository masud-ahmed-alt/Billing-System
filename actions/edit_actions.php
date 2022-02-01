<?php
session_start();
require_once '../lib/db.php';

if (isset($_POST['updateCat'])) {
    $id = $_POST['cid'];
    $ctitle = $_POST['ctitle'];

    $sqlget = "SELECT * FROM `category` WHERE `cid`='$id'";

    if (mysqli_num_rows(mysqli_query($conn, $sqlget)) == 1) {
        $sql = "UPDATE `category` SET `ctitle`='$ctitle' WHERE `cid`='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Category Updated!');window.location.href = '../manage_category.php';</script>";
        } else {
            echo "<script>alert('Something wents wrong!');window.location.href = '../manage_category.php';</script>";
        }
    }
}

// update employee 

else if (isset($_POST['updatepro'])) {
    $eid = $_POST['eid'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $adds = $_POST['adds'];

    $sql1 = "UPDATE `employe` SET 
    `username`='$username',
    `address`='$adds' WHERE `user_id`='$eid'";
    if (isExist($conn, $username, $_SESSION['user'])) {
        $_SESSION['msg'] = "Username <b>" . $username . "</b> Already Taken";
        header('location:../profile.php');
    } else {
        if (mysqli_query($conn, $sql1)) {

            $sql2 = "UPDATE `user` SET 
        `name`='$name',
        `mobile`='$mobile',
        `email`='$email' WHERE `id` = '$eid' ";

            if (mysqli_query($conn, $sql2)) {
                $_SESSION['msg'] = "Profile Updated";
                header('location:../profile.php');
            } else {
                $_SESSION['msg'] = mysqli_error($conn);
                header('location:../profile.php');
            }
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
            header('location:../profile.php');
        }
    }
}


// change password 

else if (isset($_POST['chngpass'])) {
    $eid = $_POST['id'];
    $curr_pass = md5($_POST['curr_pass']);
    $new_pass = md5($_POST['new_pass']);
    $new_passconn = md5($_POST['new_passconn']);

    if ($new_pass == $new_passconn) {

        $sql_get = "SELECT `password` FROM `employe` WHERE `user_id` ='$eid'";
        $data = mysqli_fetch_array(mysqli_query($conn, $sql_get));
        $p = $data[0];

        if ($curr_pass == $p) {
            $sql2 = "UPDATE `employe` SET `password`='$new_passconn' WHERE `user_id` ='$eid'";
            if (mysqli_query($conn, $sql2)) {
                $_SESSION['chng'] = "Password Changed Successfully";
                header('location:../profile.php');
            }
        } else {
            echo $p . "<br>";
            echo $curr_pass . "<br>";
            $_SESSION['chng'] = "Current Password did't match!";
            header('location:../profile.php');
        }
    } else {
        $_SESSION['chng'] = "Password & Confirm Password did't match!";
        header('location:../profile.php');
    }
}

//Update Products
else if (isset($_POST['updtproduct'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pcat = $_POST['category'];
    $pdesc = $_POST['desc'];

    $sqlget = "SELECT * FROM   `products` WHERE `pid` = '$pid'";
    $existData = mysqli_fetch_assoc(mysqli_query($conn, $sqlget));

    if ($pname == $existData['pname'] && $pdesc == $existData['description'] && $pcat == $existData['pcat']) {
        $_SESSION['msg'] = "No new data to update!";
        header('location:../update_product.php?pid=' . $pid . '');
    } else {

        $sq = "UPDATE `products` SET `pname`='$pname',
        `pcat`='$pcat',
        `description`='$pdesc' WHERE `pid` ='$pid'";

        if (mysqli_query($conn, $sq)) {
            $_SESSION['msg'] = "Product Updated!";
            header('location:../update_product.php?pid=' . $pid . '');
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
            header('location:../update_product.php?pid=' . $pid . '');
        }
    }
}

//update suppliers
else if (isset($_POST['updtsupplier'])) {
    $supp_id = $_POST['supp_id'];
    $sname = $_POST['sname'];
    $smob = $_POST['smob'];
    $semail = $_POST['semail'];
    $adds = $_POST['adds'];

    $sqlget = "SELECT * FROM `user` JOIN `supplier` WHERE `user`.`id`=`supplier`.`user_id`  AND `user`.`id`='$supp_id'";
    $existData = mysqli_fetch_assoc(mysqli_query($conn, $sqlget));

    if ($sname == $existData['name'] && $smob == $existData['mobile'] && $semail == $existData['email'] && $adds == $existData['address']) {
        $_SESSION['msg'] = "No new data to update!";
        header('location:../update_supplier.php?user_id=' . $supp_id . '');
    } else {

        $sqsupplier = "UPDATE `supplier` SET `address`='$adds' WHERE `user_id` = '$supp_id'";

        if (mysqli_query($conn, $sqsupplier)) {
            $sqluser = "UPDATE `user` SET `name`='$sname',`mobile`='$smob',`email`='$semail' WHERE `id` = '$supp_id'";
            if (mysqli_query($conn, $sqluser)) {
                $_SESSION['msg'] = "Supplier Updated!";
                header('location:../update_supplier.php?user_id=' . $supp_id . '');
            } else {
                $_SESSION['msg'] = mysqli_error($conn);
                header('location:../update_supplier.php?user_id=' . $supp_id . '');
            }
        } else {
            $_SESSION['msg'] = mysqli_error($conn);
            header('location:../update_supplier.php?user_id=' . $supp_id . '');
        }
    }
}


// upload image 

else if (isset($_POST['upldimg'])) {
    $id = $_POST['id'];
    $image = $_FILES['image'];

    $filename = $image['name'];
    $filepath = $image['tmp_name'];
    $fileerror = $image['error'];
    $time = time();

    // print_r($_POST);exit();

    // print_r($image);exit();
    if ($fileerror == 0) {
        $file_name = $time . $image['name'];
        $folder = "../images/" . $time . $image['name'];
        $result = mysqli_query($conn, "SELECT * FROM `employe` WHERE `user_id`='$id'");
        manageDir($result);
        if (move_uploaded_file($filepath, $folder)) {
            if (mysqli_query($conn, "UPDATE `employe` SET `image`='$file_name' WHERE `user_id` = '$id'")) {
                $_SESSION['img'] = "Profile Uploaded";
                header('location:../profile.php');
            } else {
                $_SESSION['img'] = mysqli_error($conn);
                header('location:../profile.php');
            }
        } else {
            header('location:../profile.php');
        }
    } else {
        $_SESSION['img'] = "Please Select an Image";
        header('location:../profile.php');
    }
}

function manageDir($result)
{
    $file_name = mysqli_fetch_assoc($result)['image'];
    if ($file_name != null) {
        if (unlink("../images/" . $file_name)) {
            return true;
        }
    }
    return false;
}

function isExist($conn, $username, $user)
{
    $result = mysqli_query($conn, "SELECT * FROM `employe` WHERE `username`='$username'");
    $data = mysqli_fetch_assoc($result);
    if ($data['username'] == $user['username'] && $user['id'] == $data['id']) {
        return false;
    } else {
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
