<?php

require_once "../lib/db.php";

if(isset($_GET['profit'])){
    $resp = [];
    $sql = "SELECT SUM(`bill`.`total_amount`) as `sell`,SUM(`sp`.`buy_price`) as `buy`, `sp`.`qnt`, DATE_FORMAT(`bill`.`date`, '%M') as `month` 
    FROM `bill` JOIN `sell_product` as `sp` ON `sp`.`bill_id`=`bill`.`bill_id` GROUP BY DATE_FORMAT(`date`, '%M')";
    // while($row = mysqli_fetch_assoc(mysqli_query($conn,$sql))){
    //     array_push($resp,$row);
    // }
    $resp = mysqli_fetch_all(mysqli_query($conn,$sql));
    echo json_encode($resp);
}

if(isset($_GET['daily'])){
    $resp = [];
    $sql = " SELECT (`bill`.`total_amount`) as `sell_price`,
     (`sp`.`qnt`*`sp`.`buy_price`) as `sell_price`, 
     DATE_FORMAT(`bill`.`date`, '%d-%m-%Y') as `date` 
     FROM `bill` JOIN `sell_product` as `sp` ON `bill`.`bill_id`=`sp`.`bill_id`
      GROUP BY DATE_FORMAT(`bill`.`date`, '%d-%m-%Y')";
    // while($row = mysqli_fetch_assoc(mysqli_query($conn,$sql))){
    //     array_push($resp,$row);
    // }
    $resp = mysqli_fetch_all(mysqli_query($conn,$sql));
    echo json_encode($resp);
   
}