<?php
    include "config.php";
    session_start();
    $agreeErr = $EmailErr = $unamaErr= $passErr = "";

    if(isset($_POST['signup'])){
        $Email = $_POST['email'];
        $uname = $_POST['userName'];
        $pass = $_POST['password'];
        $Agree = $_POST['agree'];

        if(empty($uname)){
            $unameErr = "*User name required";
        }
        if(empty($pass)){
            $passErr = "*Password required";
        }
        if(empty($Email)){
            $EmailErr = "*Email required";
        }
        if(empty($Agree)){
            $agreeErr = "*Check required";
        }
        
        if(!empty($Email) && !empty($uname) && !empty($pass) && !empty($Agree)){
            $sql = "INSERT INTO `accounts` (`email`, `user_name`, `password`)
                    VALUES('$Email', '$uname', '$pass')";
            $result = $connection->query($sql);
            if($result == TRUE){
                header( "Location: login.php");
            }
            else{
                echo "Already registered Email!";
            }
            $connection->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE USER ACCOUNT</title>
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
        height: 100%;
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
      .b{
        width:3%;
        margin-right:5px;
        margin-top:18px;
      }
      .a{
        width: 100%;
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
        /* background-color: #ddd; */
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
        margin:10px 0px;
      }
      button{
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
      button:hover{
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
      .or{
          display: flex;
          flex-direction: row;
      }
      .or:before, .or:after {
          content: "";
          flex: 1 1;
          border-top: thin solid #ccf2ff;
          margin: auto;
      }
    </style>
</head>

<body>
    <form action="" method="POST">
        <div class="title">CREATE</div>
        <h2>Adventure starts here</h2>
        <p>Make your user management easy and fun!</p>
        <input type="text" name="email" placeholder="Email" class="a"/>
        <span class="error"><?php echo $EmailErr;?></span><br>
        <input type="text" name="userName" placeholder="User Name" class="a"/>
        <span class="error"><?php echo $unameErr;?></span><br>
        <input type="password" name="password" placeholder="Password" class="a"/>
        <span class="error"><?php echo $passErr;?></span><br>
        <input type="checkbox" name="agree" class="b">I agree to <a href="#" style="text-decoration:none; color:#9155FD">privacy policy & terms.</a><br>
        <span class="error"><?php echo $agreeErr;?></span><br>
        <button type="signup" name="signup">Sign Up</button>
        <div id="create">Already have an account?&nbsp;<a href="login.php" style="text-decoration:none; color:#9155FD">Sign in Instead</a></div> <br>
        <div class="or">or</div>
        <div id="links">
            <a href="#" style="color: rgb(73, 124, 226);"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i></a>
            <a href="#" style="color: rgb(29, 161, 242);"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
            <a href="#" style="color: black;"><i class="fa fa-github fa-lg" aria-hidden="true"></i></a>
            <a href="#" style="color: rgb(219, 68, 55);"><i class="fa fa-google fa-lg" aria-hidden="true"></i></a>
        </div>
    </form>
</body>
</html>