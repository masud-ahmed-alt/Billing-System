<?php

require_once "../lib/db.php";

if (isset($_GET['profit'])) {
    $resp = [];
    $sql = "SELECT SUM(`sp`.`sell_price`*`sp`.`qnt`) as `sell`,SUM(`sp`.`qnt`*`sp`.`buy_price`) as `buy`, `sp`.`qnt`, DATE_FORMAT(`bill`.`date`, '%M') as `month` 
    FROM `sell_product` as `sp` JOIN `bill` ON `sp`.`bill_id`=`bill`.`bill_id` GROUP BY DATE_FORMAT(`date`, '%M')";


    // while($row = mysqli_fetch_assoc(mysqli_query($conn,$sql))){
    //     array_push($resp,$row);
    // }
    $resp = mysqli_fetch_all(mysqli_query($conn, $sql));
    echo json_encode($resp);
}

if (isset($_GET['daily'])) {
    $resp = [];
    $sql = " SELECT (`bill`.`total_amount`) as `sell_price`,
     (`sp`.`qnt`*`sp`.`buy_price`) as `sell_price`, 
     DATE_FORMAT(`bill`.`date`, '%d-%m-%Y') as `date` 
     FROM `bill` JOIN `sell_product` as `sp` ON `bill`.`bill_id`=`sp`.`bill_id`
    GROUP BY DATE_FORMAT(`bill`.`date`, '%d-%m-%Y')";
    $date = date('y',time());
    //   echo $date; exit();

    $sql2 = "SELECT SUM(`sp`.`sell_price`*`sp`.`qnt`) as `sell_price`,
    SUM(`sp`.`qnt`*`sp`.`buy_price`) as `buy_price`, 
    DATE_FORMAT(`bill`.`date`,'%d-%M-%Y') as `date` FROM `sell_product` as `sp`
    JOIN `bill` ON `sp`.`bill_id`=`bill`.`bill_id`
    GROUP BY DATE_FORMAT(`bill`.`date`, '%d-%m-%Y')";
    ;
    // while($row = mysqli_fetch_assoc(mysqli_query($conn,$sql))){
    //     array_push($resp,$row);
    // }
    $resp = mysqli_fetch_all(mysqli_query($conn, $sql2));
    echo json_encode($resp);
}
