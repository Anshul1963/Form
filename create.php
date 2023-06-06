<?php
    include "config.php";
    session_start();
    $error = NULL;
    $nameErr = $emailErr = $mobileErr = $addressErr = $genderErr = $stateErr = "";
    $loginErr = "";
    if(empty($_SESSION['name']))
    {
        $loginErr = "Login To Add Data!";
    }

    if(isset($_POST['submit']) && !empty($_SESSION['name']))  {
        $Name = $_POST['name'];
        $Email = $_POST['email'];
        $Mobile = $_POST['mobile'];
        $Address = $_POST['address'];
        $State = $_POST['state'];
        $Gender = $_POST['gender'];
        $Message = $_POST['message'];
        $Newsletter = $_POST['newsletter'];

        if(empty($Name)){
            $nameErr = "*Name is required";
            $error = 1;
        }
        elseif(!preg_match("/^[a-zA-Z ]*$/",$Name)){
            $nameErr = "*Only alphabets and white space are allowed";
            $error= 1;
        } 
        if(empty($Email)){
            $emailErr = "*Email is Required";
            $error = 1;
        }
        elseif(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
            $emailErr = "*Invalid Email Address";
            $error = 1;
        }
        if(empty($Mobile)){
            $mobileErr = "*Enter Mobile No.";
            $error = 1;
        }
        elseif(!preg_match("/^[0-9]*$/",$Mobile)){
            $mobileErr = "*Only numbers are allowed";
            $error = 1;
        }
        elseif(strlen($Mobile) <10 || strlen($Mobile) >10){
            $mobileErr = "*Enter 10 digit mobile no.";
            $error = 1;
        }
        if(empty($Address)){
            $addressErr = "*Field can't be empty";
            $error = 1;
        }
        if(empty($Gender)){
            $genderErr = "*Select a gender";
            $error = 1;
        }
        if(($State === "Select State")){
            $stateErr = "*State required";
            $error = 1;
        }
    
        if($error == NULL){
            $sql = "INSERT INTO `user_details`(`name`,`email`,`mobile`,`address`,`state`,`gender`,`message`,`newsletter`)
                    VALUES ('$Name','$Email','$Mobile','$Address','$State','$Gender','$Message','$Newsletter')";
            $error = NULL;
            $result = $connection->query($sql);
            if($result==TRUE){
                header("Location: read.php");
            }
            else{
                echo "Duplicate Email !";   
            }
            $connection->close();
        }     
    } 
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP CRUD</title>
<style>
    * {
        box-sizing: border-box;
        margin:0px;
        font-family: Inter,sans-serif,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,
                    "Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    }

    nav{
        display:flex;
        justify-content:space-between;
        align-items:center;
        min-height: 12vh;
        background-color:teal;
        font-family: "Montserrat", sans-serif;
    } 
    .navbar{
        color:white;
        letter-spacing:5px;
        font-size:35px;
        margin-left:20px
    }
    .nav-link{
        display:flex;
        justify-content:flex-end;
        width:18%;
        margin-right: 5px;
    }
    .nav-link li{
        list-style:none;
    }
    .nav-link a{
        color:white;
        text-decoration:none;
        letter-spacing:3px;
        font-weight: bold;
        font-size: 20px;
        padding: 14px 16px;
    }
    .nav-link a:hover:not(.active) {
        background-color: lightseagreen;
    }
    
    .nav-link li a.active {
        background-color: #4caf50;
    }
    .user-detail{
        background-color: #F4F5F4;
        padding-top:10px;
    }
    form {
        height: 100%;
        border: 2px solid #f1f1f1;
        border-radius: 8px;
        padding: 16px;
        background-color: white;
        margin:auto;
        box-shadow:0px 2px 10px 0px rgb(58 53 65 / 10%);
        color:rgba(58, 53, 65, 0.87);
        width:40%;
    }
    .form-title{
       text-align:center; 
       margin:10px 0px;
    }
    .form-title h2{
        font-weight:600;
        font-size:35px;
        letter-spacing:3px;
    }
    input,select,textarea{
        width: 100%;
        padding: 13px;
        margin: 15px 0 0 0;
        display: inline-block;
        border: none;
        font-size:15px;
    }
    select{
        background-color:transparent;
        border-radius:6px;
        border:1px solid #ddd;
    }
    input,textarea{
        border-radius:6px;
        border:1px solid #ddd;
        /* margin:15px 0 0 0; */
    }
    input[type=text]:focus, select:focus, textarea:focus{
        /* background-color: #ddd; */
        outline: none;
        border:2px solid #9155FD;
    }
    label{
        font-size: 20px;
        display:block;
        margin-top:10px;
    }
    .radio{
        width:3%;
        margin-right:5px;
    }
    .error{
        color: #FF0001;
    } 
    .loginErr{
        color: #FF0001;
        text-align: center;
        font-size:25px;
        display: block;
    }
    button[type=submit] {
        background-color: #9155FD;
        border-radius:5px;
        color: #ffffff;
        padding: 10px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        font-size: 20px;
    }
    button[type=submit]:hover {
        background-color:#814b9b;
    }
</style>
</head>

<body>
    <nav>
        <div class="navbar">
            <h4>LOGO</h4>
        </div>
        <ul class="nav-link">
            <?php
                if(isset($_SESSION['name']))
                {
            ?>
            <li><a href="read.php">View</a></li>
            <li><a href="logout.php">Logout</a></li>
            
            <?php
                }
                if (!isset($_SESSION['name']))
                {  
            ?>
            <li><a href="login.php">Login</a></li> 
            <?php }?>   
        </ul>
    </nav>

    <div class="user-detail">
        <span class="loginErr"><?php echo $loginErr;?></span>
        <form method="POST" action="">
            <div class="form-title">
                <h2>ADD DETAILS</h2>
            </div>
            <!-- <label>Full Name</label> -->
            <input type="text" placeholder="Full name" name="name" >
            <span class="error"><?php echo $nameErr;?></span><br>
            <!-- <label>Email</label> -->
            <input type="text" placeholder="E-mail address" name="email" >
            <span class="error"><?php echo $emailErr;?></span><br>
            <!-- <label>Mobile</label> -->
            <input type="text" placeholder="Mobile no." name="mobile" >
            <span class="error"><?php echo $mobileErr;?></span><br>
            <!-- <label>Address</label> -->
            <input type="text" placeholder="Permanent Address" name="address" >
            <span class="error"><?php echo $addressErr;?></span><br>
            <!-- <label>State</label> -->
            <select id="state" name="state">
                <option>Select State</option>
                <option value="Delhi" name="state">Delhi</option>
                <option value="Rajasthan" name="state">Rajasthan</option>
                <option value="Punjab" name="state">Punjab</option>
                <option value="Maharastra" name="state">Maharastra</option>
            </select>
            <span class="error"><?php echo $stateErr;?></span><br>
            <label>Gender</label>
                <input type="radio" value="Male" name="gender" class="radio">Male</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" value="Female" name="gender" class="radio">Female</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" value="Others" name="gender" class="radio"><span style="margin-right:200px;">Others</span> </input> 
                <span class="error"><?php echo $genderErr;?></span><br>
            <!-- <label>Message</label> -->
            <textarea name="message" rows="2" cols="30" placeholder="Message(if any)"></textarea>
            <label style="display:inline;">Newsletter:</label>
            <input type="checkbox" name="newsletter" class="radio"><br>
            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
    </div>
</body>
</html>