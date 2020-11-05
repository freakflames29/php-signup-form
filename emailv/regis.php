<?php
session_start();

# code...

$flag = false;
$us = false;
$pa = false;
if (isset($_POST['submit'])) {
    require "database.php";

    // $name = mysqli_real_escape_string($con, $_POST['username']);
    $email=mysqli_real_escape_string($con, $_POST['email']);
    $pas = mysqli_real_escape_string($con, $_POST['password']);
    $cpas = mysqli_real_escape_string($con, $_POST['cpassword']);
    $_SESSION['el']=$email;

    if ($cpas !== $pas) {
        $pa = true;
        # code...
    } else {
        $hashpas = password_hash($pas, PASSWORD_DEFAULT);

        // creating token
        $token=bin2hex(random_bytes(15));
          
        // checking username is present or not
        $que = "SELECT * FROM registration WHERE username='$email'";
        $exq = mysqli_query($con, $que);
        // $res=mysqli_
        $rowc = mysqli_num_rows($exq);
        if ($rowc > 0) {
            // header("Location:regis.php?UserNameExists");
            // exit();
            $us = true;
        } else {
            $inser = "INSERT INTO registration(username,password,token,status) VALUES('$email','$hashpas','$token','inactive')";
            $iq = mysqli_query($con, $inser);
            
            // sending email
            $to_email=$email;
            $subject="Email verification";
            $body="Hello please click the link in given below to activate your account 
            http://localhost:10080/emailv/activate.php?tk=$token

            ";
            $headers="From:troopjava@gmail.com";
            if(mail($to_email,$subject,$body,$headers))
            {
                    $_SESSION['msg']="check mail $email to activate your account " ;
                    header("location:login.php");
            }
            else
            {
                    echo "failed";  
            }
            // header("Location:regis.php?Successfullyregisterd");
            // exit();
        }
    }
    mysqli_close($con);
}


?>
<?php
if(isset($_SESSION['id']))
{
    header("location:index.php");
}
?>

<?php
if (isset($_COOKIE['usec']) || isset($_SESSION['id'])) {

    header("location:index.php");
} else {
    echo '<!doctype html>
    <html lang="en">
    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
        <title>Register!</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body class="ml-4">
        <form action="regis.php" method="post">
            <div class="form-group ml-4 mt-4">
                <h1>Register!</h1>';
?>
           

                <?php
                if ($pa == true) {
                    echo '<div class="alert alert-danger" role="alert">
                   password is not matching
                  </div>';
                }
                ?>
                <?php
                echo '
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>';
                ?>
                <?php
                if ($us == true) {
                    echo '<div class="alert alert-danger" role="alert">
                    Email already exists
                  </div>';
                }

                ?>
    <?php
    echo ' </div>
            <div class="form-group  ml-4 mt-4">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
            </div>
            <div class="form-group  ml-4 mt-4">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" required>
                <small id="emailHelp" class="form-text font-weight-bold "></small>
    
            </div>
            <div id="here">
    
            </div>
            <!-- <div class="alert alert-danger ml-4" role="alert">
                <!-- A simple danger alert—check it out! -->
            <!-- </div>  -->
    
            <button type="submit" id="submit" name="submit" class="btn btn-primary  ml-4 mt-2">Register</button>
            <a href="login.php"><button type="button" class="btn btn-success ml-4 mt-2">Login</button></a>
        </form>
    
        <!-- Optional JavaScript; choose one of the two! -->
    
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <!--    <script src="val.js"></script>-->
        <script src="fun.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
        <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
        <!-- <script src="val.js"></script> -->
    </body>
    
    </html>';
}
    ?>