<?php
    include "config.php";

    $passErr = $repassErr = $codeErr = "";
    $passNotMatched = "";
    $Email = "";
    $otp = "";
    if(isset($_GET['email'])){
        $Email = $_GET['email'];
    }

    if(isset($_POST['reset'])){
        $Password = $_POST['password'];
        $RePassword = $_POST['Re-password'];
        $Code = $_POST['code'];

        if(empty($Password)){
            $passErr = "*Enter Password";
        }
        if(empty($RePassword)){
            $repassErr = "*Re-type Password";
        }
        if(empty($Code)){
            $codeErr = "*Enter Code";
        }
        if($Password !== $RePassword){
            $passNotMatched = "Passwords Not Matched";
        }
        $sql2 = "SELECT code FROM `accounts` WHERE `code` = '$Code' ";
        $result2 = $connection->query($sql2);
        $data = $result2->fetch_assoc();

        if($data['code'] !== $Code){
            $otp = "Verification Code Not Matched !";
        }

        if(!empty($Password) && !empty($RePassword) && ($Password === $RePassword) && ($data['code'] === $Code) )
        {
            $sql = "UPDATE `accounts` SET `password`='$Password' WHERE `email`='$Email'";
            $result = $connection->query($sql);
            if($result){
                header("location: login.php");
            }
            else{
                echo "Error !";
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
    <title>Reset password</title>
    <style>
      *{
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
      .error{
        color: #FF0001;
        font-size:15px;
      } 
      .passNotMatched{
        color: #FF0001;
        text-align: center;
        font-size:25px;
        display: block;
      }

    </style>
  </head>
  <body> 
    <span class="passNotMatched"><?php echo $otp;?></span>
    <form action="" method="POST">
        <div class="title">RESET PASSWORD</div>
        <h2>Welcome to CRUD</h2>
        <p>Please reset password to login.</p>
        <span class="passNotMatched"><?php echo $passNotMatched;?></span>
        <input type="text" name="code" placeholder="Verification Code" class="a"/>
        <span class="error"><?php echo $codeErr;?></span><br>
        <input type="password" name="password" placeholder="New Password" class="a"/>  
        <span class="error"><?php echo $passErr;?></span><br>     
        <input type="password" name="Re-password" placeholder="Confirm password" class="a"/>  
        <span class="error"><?php echo $repassErr;?></span><br>
        <button type="submit" name="reset" class="btn">Reset Password</button>
    </form>
  </body>
</html>