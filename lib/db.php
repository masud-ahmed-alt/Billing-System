<?php

$conn = mysqli_connect("localhost","root","","selldb");
if(mysqli_connect_errno()){
    echo mysqli_connect_errno();
}