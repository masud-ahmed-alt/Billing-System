<?php
require_once "../lib/db.php";
require_once "crud.php";

if (isset($_POST['product_id'])) {
    $resp = [];
    $product_id = $_POST['product_id'];
    $session_id = $_POST['session_id'];
    $sql = "SELECT * FROM `temp_product` WHERE `product_id`='$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $qnt = mysqli_fetch_assoc($result)['qnt'] + 1;
        if (mysqli_query($conn, "UPDATE `temp_product` SET `qnt` = '$qnt' WHERE `product_id`='$product_id'")) {
            $resp['data'] = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `temp_product`"));
            $resp['error'] = false;
            echo json_encode($resp);
        } else {
            $error['error'] = true;
            $error['count'] = $qnt;
            $error['msg'] = mysqli_error($conn);
            echo json_encode($error);
        }
    } else {
        if (mysqli_query($conn, "INSERT INTO `temp_product` (`product_id`,`session_id`) VALUES ('$product_id','$session_id')")) {
            $resp['data'] = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `temp_product`"));
            $resp['error'] = false;
            echo json_encode($resp);
        } else {
            $error['error'] = true;
            $error['msg'] = mysqli_error($conn);
            echo json_encode($error);
        }
    }
}

if (isset($_GET['session_id'])) {
    $resp = [];
    $session_id = $_GET['session_id'];
    $sql = "SELECT `p`.`pid`, `p`.`pname`, `p`.`description`, `tp`.`qnt`, `iv`.`sell_price`, `iv`.`qnt_in_hand` FROM 
     `temp_product` as `tp` JOIN `products` as `p` ON `tp`.`product_id`=`p`.`pid` JOIN `inventory` as `iv` ON 
     `tp`.`product_id`=`iv`.`pid` WHERE `session_id`='$session_id'";
    // echo json_encode(["sql" => $sql]);
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($resp, $row);
    }
    echo json_encode($resp);
}

if (isset($_POST['pid']) && isset($_POST['sid'])) {
    $resp = [];
    $pid = $_POST['pid'];
    $sid = $_POST['sid'];
    $sql = "SELECT * FROM `temp_product` WHERE `session_id`='$sid' AND `product_id`='$pid'";
    $data = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if ($data['qnt'] == 1) {
        if (mysqli_query($conn, "DELETE FROM `temp_product` WHERE `product_id`='$pid' AND `session_id`='$sid'")) {
            $resp['removed'] = true;
        } else {
            $resp['error'] = mysqli_error($conn);
        }
    } else {
        if ($data['qnt'] != 0) {
            $qnt = $data['qnt'] - 1;
            if (mysqli_query($conn, "UPDATE `temp_product` SET `qnt` =  '$qnt' WHERE `session_id`='$sid' AND `product_id`='$pid'")) {
                $resp['removed'] = false;
                $data['updated']  = true;
            }
        }
    }
    $resp['msg'] = $_POST;
    echo json_encode($resp);
}
