<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "anshul";
$connection = new mysqli($servername,$username,$password,$dbname);

if(!$connection)
{
    echo "Connection failed";
}