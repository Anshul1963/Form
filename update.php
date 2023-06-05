<?php
    include "config.php";

    $error = NULL;
    $nameErr = $emailErr = $mobileErr = $addressErr = $genderErr = $messageErr = "";

    // For updating details.
    if(isset($_POST['update']))
    {   $user_id = $_POST['user_id'];
        $Name = $_POST['name'];
        $Email = $_POST['email'];
        $Mobile = $_POST['mobile'];
        $Address = $_POST['address'];
        $State = $_POST['state']; 
        $Gender = $_POST['gender'];
        $Message = $_POST['message'];

        if(empty($Name)){
            $nameErr = "*Name is required";
            $error = 1;
        }
        elseif (!preg_match("/^[a-zA-Z ]*$/",$Name))
        {
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
            $mobileErr = "*Only numeric values are allowed";
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
        if(empty($Message)){
            $messageErr = "*Enter message";
            $error = 1;
        }

        if($error == NULL){
            $sql = "UPDATE `user_details` SET `name`='$Name', `email`='$Email', `mobile`='$Mobile',`address`='$Address',
                    `state`='$State',`gender`='$Gender', `message`='$Message' Where `id`='$user_id'";

            $result = $connection->query($sql); 
            if($result == TRUE){
                header("Location: read.php");
            }
            else{
                echo '<script>alert("Error".$sql.$connection->error)</script>';
            }
        }
    }


    if(isset($_GET['id']))
    {
        $user_id = $_GET['id'];
        $sql = " SELECT * FROM `user_details` WHERE `id`='$user_id' ";
        $result  = $connection->query($sql);
        if($result){
            while($data=$result->fetch_assoc()){   
                $id = $data['id'];
                $Name = $data['name'];
                $Email = $data['email'];
                $Mobile = $data['mobile'];
                $Address = $data['address'];
                $State = $data['state'];
                $Gender = $data['gender'];
                $Message = $data['message'];
                
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
    
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
            font-size:15px
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
            font-size:20px;
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
            <li><a href="read.php">Back</a></li>
        </ul>
    </nav>

    <div class="user-detail">

        <form method="POST" action="">
            <div class="form-title">
                <h2>UPDATE DETAILS</h2>
            </div>
            <!-- <label>ID</label> -->
            <input type="text" placeholder="Id" name="user_id" value="<?php echo $id; ?>">
            <!-- <label>Full Name</label> -->
            <input type="text" placeholder="Enter full name" name="name" value="<?php echo $Name;?>">
            <span class="error"><?php echo $nameErr;?></span><br>
            <!-- <label>Email Address</label> -->
            <input type="email" placeholder="Enter e-mail address" name="email" value="<?php echo $Email;?>">
            <span class="error"><?php echo $emailErr;?></span><br>
            <!-- <label>Mobile</label> -->
            <input type="mobile" placeholder="Enter mobile no." name="mobile" value="<?php echo $Mobile;?>" >
            <span class="error"><?php echo $mobileErr;?></span><br>
            <!-- <label>Address</label> -->
            <input type="text" placeholder="Enter Permanent Address" name="address" value="<?php echo $Address;?>">
            <span class="error"><?php echo $addressErr;?></span><br>
            <!-- <label>State</label> -->
            <select id="state" name="state">
                <option value="">Select state</option>
                <option value="Delhi" name="state" <?php if($State == 'Delhi'){echo "selected";}?>>Delhi</option>
                <option value="Rajasthan" name="state" <?php if($State == 'Rajasthan'){echo "selected";}?>>Rajasthan</option>
                <option value="Punjab" name="state" <?php if($State == 'Punjab'){echo "selected";}?>>Punjab</option>
                <option value="Maharastra" name="state" <?php if($State == 'Maharastra'){echo "selected";}?>>Maharastra</option>
            </select>
            <label>Gender</label>
                <input type="radio" value="Male" name="gender" class="radio" <?php if($Gender == 'Male'){ echo "checked";} ?>>Male</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" value="Female" name="gender" class="radio" <?php if($Gender == 'Female'){ echo "checked";} ?>>Female</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" value="Others" name="gender" class="radio" <?php if($Gender == 'Others'){ echo "checked";} ?>>Others</input>
                <span class="error"><?php echo $genderErr;?></span><br>
            <!-- <label>Message</label><br> -->
            <textarea name="message" rows="2" cols="30" placeholder="Enter message(if any)"> <?php echo $Message;?></textarea>
            <span class="error"><?php echo $messageErr;?></span><br>
            <label style="display:inline;">Newsletter:</label>
            <input type="checkbox" name="newsletter" class="radio">
            <button type="submit" name="update" value="update">Update</button>
        </form>
    </div>
</body>
</html>