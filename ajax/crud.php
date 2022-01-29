<?php

function get($conn,$sql)
{
    $res = [];
    $result = mysqli_query($conn,$sql);
    $res = mysqli_fetch_all($result);
    echo json_encode($res);
}

function post($conn,$sql)
{
    # code...
}