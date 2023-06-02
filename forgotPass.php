<?php
    include "config.php";
    include "sendEmail.php";

    $EmailErr = "";
    $emailNotMatched = "";
    if(isset($_POST['verify'])){   
        $Email = $_POST['email'];
        if(empty($Email)){
            $EmailErr = "*Enter email";
        }
        if(!empty($Email)){
            $sql = " SELECT * FROM `accounts` WHERE email = '".$Email."' ";
            $result = $connection->query($sql);
            $row = mysqli_num_rows($result);
            $code = rand(100000 , 999999);
            $sql2 = "UPDATE `accounts` SET `code` = '$code' WHERE email = '".$Email."' ";
            $result2 = $connection->query($sql2);
            if($row === 1){
                
                $sendMI->send($code, $Email);
                header("location: resetPass.php?email=$Email");
            }
            else{
                $emailNotMatched = "No user is registered with this email";
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
    <title>Verify Email</title>
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
      .error{
        color: #FF0001;
        font-size:15px;
      } 
      .emailNotMatched{
        color: #FF0001;
        text-align: center;
        font-size:25px;
        display: block;
      }

    </style>
  </head>
  <body> 
    <form action="" method="POST">
        <div class="title">VERIFY EMAIL </div>
        <h2>Welcome to CRUD</h2>
        <p>Please verify E-mail to reset password.</p>
        <span class = "emailNotMatched"><?php echo $emailNotMatched;?></span>
        <input type="text" name="email" placeholder="E-mail" class="a"/>  
        <span class="error"><?php echo $EmailErr;?></span><br>     
        <button type="submit" name="verify" class="btn">Verify</button>
    </form>
  </body>
</html>