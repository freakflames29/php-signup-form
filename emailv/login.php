<?php
ob_start();
session_start();
//require 'header.php';
?>

<?php
$flag = $us = false;
require 'database.php';
if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pasw = mysqli_real_escape_string($con, $_POST['password']);
    //    check for username
    $sql = "SELECT * FROM registration WHERE username='$email' AND status='active'";
    $query = mysqli_query($con, $sql);
    if($query)
    {
        $row = mysqli_num_rows($query);
        if ($row) {
            $p = mysqli_fetch_assoc($query);
            $dbpass = $p['password'];
            //                verification of password
            $pasdcode = password_verify($pasw, $dbpass);
            if ($pasdcode) {
                $_SESSION['user'] = $p['username'];
                $_SESSION['id'] = $p['id'];
                if (isset($_POST['check'])) {
                    setcookie("usec", $usern, time() + 86400);
                    setcookie("passc", $pasw, time() + 86400);
                    header("Location:index.php");
                } else {
                    header("Location:index.php");
                }
                //                        echo "login success";
                header("Location:index.php");
            } else {
                $us = true;
            }
        } else {
            $flag = true;
        }
    }
    }
    

   


?>


<!doctype html>
    <html lang="en">
    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
        <title>Login!</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body class="ml-4">
        <form action="login.php" method="post" >
        <div class="form-group ml-4 mt-4">
        <h1>Login!</h1>

     
    




    <?php
    if ($us == true) {
        echo '<div class="alert alert-danger" role="alert">
                Password incorrect
              </div>';
    }

    ?>
    <?php
    if ($flag == true) {
        echo "<div class='alert alert-danger' role='alert'>
                        Invalid email
                         </div>";
    }
    //            
    ?>
    <?php
                if(isset($_SESSION['id']))
                {
                    header("location:index.php");
                }
                else
                {
                            
                }
    ?>
        <?php

            echo "<div class='alert alert-info' role='alert'>";
                    if(isset($_SESSION['msg']))
                    {
                       echo $_SESSION['msg'];
                    }
                    else
                    {
                        $_SESSION['msg']="You are logged out";
                        echo $_SESSION['msg'];
                    }
                            echo "</div>";
    ?>
 <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>

        </div>
        <div class="form-group  ml-4 mt-4">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
        </div>
        <!--        <div class="form-group  ml-4 mt-4">-->
        <!--            <label for="exampleInputPassword1">Confirm Password</label>-->
        <!--            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" required>-->
        <!--            <small id="emailHelp" class="form-text text-muted">Password should match.</small>-->
        <!---->
        <!--        </div>-->
        <div id="here">

        </div>
        <!-- <div class="alert alert-danger ml-4" role="alert">
        <!-- A simple danger alert—check it out! -->
        <!-- </div>  -->
        <div class="form-group  ml-4 mt-4">

            <input type="checkbox" name="check">Remember me</input>
        </div>
        <button type="submit" id="submit" name="submit" class="btn btn-primary  ml-4 mt-2">Login</button>
        <a href="regis.php"> <button type="button" class="btn btn-danger ml-4 mt-2">Register</button></a>

    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!--    <script src="val.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>

</html>
 