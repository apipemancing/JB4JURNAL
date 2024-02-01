<?php

$host="127.0.0.1";
$user="root";
$password="";
$db="jurnaljb4";

$koneksi = mysqli_connect($host,$user,$password,$db);
if (!$koneksi){
    die("koneksi gagal:".mysqli_connect_error());
}
?>