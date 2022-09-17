<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPasssword = "";
$dbnName = "fruitable";

$conn= mysqli_connect($dbServername ,$dbUsername ,$dbPasssword, $dbnName);

if(!$conn){
    echo "failed".mysqli_connect_error();
}
?>