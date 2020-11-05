<?php
session_start();
session_destroy();
setcookie("usec", '', time() - 86400);
setcookie("passc", '', time() - 86400);
header("location:login.php");
