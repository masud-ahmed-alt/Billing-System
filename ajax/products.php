<?php
require_once "../lib/db.php";
require_once "crud.php";

if (isset($_POST['product_id'])) {
    $resp = [];
    $product_id = $_POST['product_id'];
    $session_id = $_POST['session_id'];
    $sql = "SELECT * FROM `temp_product` WHERE `product_id`='$product_id' AND `session_id`='$session_id'";
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

if (isset($_GET['contact'])) {
    $contact = $_GET['contact'];
    $sql = "SELECT * FROM `user` WHERE `mobile`='$contact'";
    $resp = [];
    $resp = mysqli_fetch_all(mysqli_query($conn, $sql));
    echo json_encode($resp);
}

if (isset($_POST['name']) && isset($_POST['mobile'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $resp = [];
    if (mysqli_query($conn, "INSERT INTO `user` (`name`,`mobile`) VALUES('$name','$mobile')")) {
        $resp['success'] = true;
        $resp['id'] = mysqli_insert_id($conn);
    } else {
        $resp['success'] = false;
    }
    echo json_encode($resp);
}

if (isset($_POST['finalSubmit']) && isset($_POST['session_id'])) {
    $session_id = $_POST['session_id'];
    $products = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `temp_product` WHERE `session_id`='$session_id'"));
    $emp_id = $_POST['emp_id'];
    $customer = $_POST['customer'];
    $total_amount = $_POST['total_amount'];
    $total_gst = $_POST['total_gst'];
    // $resp['data'] = $products;
    $bill_id = "OD" . date('Y', time()) . time();
    

    if (mysqli_query($conn, "INSERT INTO `bill` (`bill_id`,`total_amount`, `total_gst`, `customer_id`,`emp_id`) VALUES ('$bill_id','$total_amount','$total_gst','$customer','$emp_id')")) {
        for ($i = 0; $i < count($products); $i++) {

            $product_id = $products[$i][1];
            $product_qnt = $products[$i][3];

            $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `p`.`pname`, `p`.`description` as `des`, `i`.`sell_price`, `i`.`buy_price`,`p`.`pid` FROM `products` AS `p` JOIN `inventory` as `i` ON `i`.`pid`=`p`.`pid` WHERE `p`.`pid`='$product_id'"));
            $desc = $product['des'];
            $sell_price = $product['sell_price'];
            $buy_price = $product['buy_price'];
            $sql_sell_product = "INSERT INTO `sell_product` (`bill_id`,`product_id`,`qnt`,`desc`,`sell_price`,`buy_price`) 
            VALUES ('$bill_id','$product_id','$product_qnt','$desc','$sell_price','$buy_price')";
            if (mysqli_query($conn, $sql_sell_product)) {
                if (mysqli_query($conn, "DELETE FROM `temp_product` WHERE `session_id`='$session_id' AND `product_id`='$product_id'")) {
                    $qnt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `qnt_in_hand` FROM `inventory` WHERE `pid`=$product_id"))['qnt_in_hand'] - $product_qnt;
                    if ($qnt <= 0) {
                        $sql_up = "DELETE FROM `inventory` WHERE `pid`='$product_id'";
                    } else {
                        $sql_up = "UPDATE `inventory` SET `qnt_in_hand`='$qnt' WHERE `pid`='$product_id'";
                    }

                    if (mysqli_query($conn, $sql_up)) {
                        $resp['success'] = true;
                        $resp['bill_id'] = $bill_id;
                    } else {
                        $resp['success'] = true;
                        $resp['msg'] = mysqli_error($conn);
                    }
                } else {
                    $resp['success'] = false;
                    $resp['msg'] = mysqli_error($conn);
                }
            } else {
                $resp['success'] = false;
                $resp['msg'] = mysqli_error($conn);
            }
        }
    } else {
        $resp['success'] = false;
        $resp['msg'] = mysqli_error($conn);
    }

    echo json_encode($resp);
}

if (isset($_GET['reset_session'])) {
    $session_id = $_GET['reset_session'];
    $sql = "DELETE FROM `temp_product` WHERE `session_id`='$session_id'";
    mysqli_query($conn, $sql);
    echo "<script>window.location.href = '../generate_bills.php'</script>";
}
