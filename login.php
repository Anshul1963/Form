<?php
    include "config.php";

    session_start();
    $unameErr = $passErr = $loginErr = "";
    if(isset($_POST['login']))
    {
      $uname = $_POST['userName'];
      $pass = $_POST['password'];

      if(empty($uname)){
        $unameErr = "*User Name is Required";
      }
      if(empty($pass)){
        $passErr = "*Password required";
      }
    
      if(!empty($uname) && !empty($pass))
      {
        $sql = "SELECT * FROM `accounts` WHERE `user_name`='$uname' AND `password`='$pass' ";
        $result = $connection->query($sql);
        if (mysqli_num_rows($result) === 1) {
            $data = mysqli_fetch_assoc($result);
            if ($data['user_name'] === $uname && $data['password'] === $pass) {
                $_SESSION['name'] = $data['user_name'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['id'] = $data['id'];
                header("Location: create.php");
                exit();
            }
            else{
              $loginErr = "Invalid Credentials";    
            }
        }
        else{
          $loginErr = "Invalid Credentials";   
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      * {
        box-sizing: border-box;
        margin: 0px;
      }

      body{
        background-color: #F4F5F4;
      }
      form {
        border: 2px solid #f1f1f1;
        border-radius:6px;
        padding: 20px;
        background-color: white;
        margin: auto;
        margin-top:5vh;
        width: 35%;
        color:rgba(58, 53, 65, 0.87);
        box-shadow:0px 2px 10px 0px rgb(58 53 65 / 10%);
        font-family: Inter,sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,
                    "Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
      }
      form h2{
        margin:5px 0;
      }
      .a{
        width: 98%;
        height:45px;
        padding: 7px;
        margin: 18px 0 0 0;
        display: inline-block;
        border: 1px solid aquamarine;
        border-radius: 5px;
        background: none;
        font-size: 18px;
        outline:none;
      }
      .a:hover{
        background-color: #ddd;
        outline:none;
      }
      .a:focus{
        border:2px solid #9155FD;
      }
      .title{
        font-size:35px;
        font-weight:600;
        letter-spacing:3px;
        text-align:center;
        margin:20px 0px;
      }
      .btn{
        background-color: #9155FD;
        color: #ffffff;
        padding: 10px 20px;
        margin: 25px 0;
        border: none;
        border-radius:5px;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        font-size: 20px;
      }
      .btn:hover{
        background-color: #814b9b;
      }
      #create{
        text-align:center;
      }
      #links{
        display: flex;
        justify-content: center;
        margin-top:15px;
      }
      #links a{
          text-decoration:none;
          padding: 10px;
      }
      .error{
        color: #FF0001;
        font-size:15px;
      } 
      .loginErr{
        color: #FF0001;
        text-align: center;
        font-size:20px;
        display: block;
      }
      #forgot{
        display: flex;
        justify-content: space-between;
        margin-top:15px;
      }
      #forgot a{
        text-decoration: none;
        color: #9155FD;
      }
    </style>
  </head>
  <body> 
    <form action="" method="POST">
        <div class="title">LOGIN</div>
        <h2>Welcome to CRUD</h2>
        <p>Please sign-in to your account and start the adventure</p>
        <span class="loginErr"><?php echo $loginErr;?></span><br>
        <input type="text" name="userName" placeholder="User Name" value="<?php echo $userName;?>" class="a"/>
        <span class="error"><?php echo $unameErr;?></span><br>
        <input type="password" name="password" placeholder="Password" value="<?php echo $pass;?>" class="a"/>
        <span class="error"><?php echo $passErr;?></span><br>
        <div id="forgot">
            <div><input type="checkbox" name="newsletter" >&nbsp;Remember Me</div> 
            <a href="forgotPass.php">Forgot Password?</a>
        </div>
        
        <button type="submit" name="login"class="btn">Login</button>
        <div id="create">New to our platform?&nbsp;<a href="createAccount.php" style="text-decoration:none; color:#9155FD">Create an Account</a><br><br>or</div> 
        <div id="links">
            <a href="#" style="color: rgb(73, 124, 226);"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i></a>
            <a href="#" style="color: rgb(29, 161, 242);"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
            <a href="#" style="color: black;"><i class="fa fa-github fa-lg" aria-hidden="true"></i></a>
            <a href="#" style="color: rgb(219, 68, 55);"><i class="fa fa-google fa-lg" aria-hidden="true"></i></a>
        </div>
    </form>
  </body>
</html>
