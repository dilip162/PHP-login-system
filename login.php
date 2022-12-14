<?php
$login=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $login=false;
    include 'partials/_dbconnect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $exist=false;

    
        // $sql="SELECT * FROM users where username='$username' AND password='$password'";
        $sql="SELECT * FROM users where username='$username'";
        $result=mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);

        if($num==1){
          while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$username;
                header("location:welcome.php");
            }else{
              $showerror='Invalid credentials';
          }
          }            
            
        }
    else{
        $showerror='Invalid credentials';
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>

    <?php

    if($login){
   
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> you are logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';        
    }

    if($showerror){
   
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong>'.$showerror.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';        
    }

    ?>

    <div class="container">
        <h1 class="text-center my-4">Login to our website</h1>

        <!-- form -->
        <form action="/loginsystem/login.php" method="post">
            <div class="mb-3 form-group col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3 form-group col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary form-group col-md-2">Login</button>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>