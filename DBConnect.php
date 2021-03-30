<?php

$host = "localhost"; 
$user = "root"; //db account name
$password = "";
$dbname = "work_Out_Wizard";

$con = new mysqli ($host, $user, $password, $dbname)
        or die('Could not connect to database.'. mysqli_connect_error($con));

//add function to sanitize data
if($con->connect_error){
    die ("connecion failed: " . $con->connect_error);
}

    //echo 'Connection success';
//print_r($con);

