<?php
session_start();
include "database.php";
if(isset($_GET['tk']))
{
    $tokenStore=$_GET['tk'];
    $temp= $_SESSION['el'];
    $ano="SELECT * FROM registration WHERE username='$temp'";
    $res=mysqli_query($con,$ano);
    $tkm=mysqli_fetch_assoc($res);
    $strtoken=$tkm['token'];
    if($strtoken==$tokenStore)
    {
        $sql="UPDATE registration SET status='active' WHERE token='$tokenStore'";
        $query=mysqli_query($con,$sql);
        if($query)
        {
            if(isset($_SESSION['msg']))
            {
                $_SESSION['msg']="Account activate succesfully";
                header("location:login.php");
            }
            else
            {
                $_SESSION['msg']="Invalid url please register another time";
                header("location:login.php");
            }
    
        }
    }
   
    else
    {
             $_SESSION['msg']="Invalid url please register another time";
            header("location:login.php");
    }
}

?>