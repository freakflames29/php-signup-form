<?php

// connecting to databse
$host = "localhost";
$username = "root";
$password = "";
$dbname = "emailphp";

$con = mysqli_connect($host, $username, $password, $dbname);
if(!$con)
{
    die("i am dying");
}
else
{
    // echo "i am connected";
}
