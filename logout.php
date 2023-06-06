<?php
    session_start();
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    unset($_SESSION['id']);
    session_destroy();

    if(isset($_POST['re-login'])){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN</title>
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
        margin-top:8vh;
        width: 35%;
        color:rgba(58, 53, 65, 0.87);
        box-shadow:0px 2px 10px 0px rgb(58 53 65 / 10%);
        font-family: Inter,sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,
                    "Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
      }
      form h2{
        margin:30px 0 8px 0;
      }
      form p{
        text-align:center;
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
    </style>
  </head>
  <body> 
    <form action="" method="POST">
        <h2>You have successfully logged out</h2>
        <p>Thanks for using our platform.</p>
        <button type="submit" name="re-login"class="btn">Re-Login</button>  
    </form>
  </body>
</html>