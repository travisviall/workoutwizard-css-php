<?php
session_start();

require_once 'DBConnect.php';

$firstname = htmlentities(stripslashes(htmlspecialchars($_POST['firstName'])));
$lastname = htmlentities(stripslashes(htmlspecialchars($_POST['lastName'])));
$username = htmlentities(stripslashes(htmlspecialchars($_POST['userName'])));
$useremail = htmlentities(stripslashes(htmlspecialchars($_POST['email'])));
$userpassword = hash("ripemd128", $_POST['password2']);
$heightfeet = htmlentities(stripslashes(htmlspecialchars($_POST['heightFeet'])));
$heightinches = htmlentities(stripslashes(htmlspecialchars($_POST['heightInches'])));
$weight = htmlentities(stripslashes(htmlspecialchars($_POST['weight'])));
$dob = htmlentities(stripslashes(htmlspecialchars($_POST['DOB'])));

$date = date("Y-m-d");

$_SESSION['firstName'] = $firstname;
$_SESSION['lastName'] = $lastname;
$_SESSION['userName'] = $username;



$trueheight = ($heightfeet *12) + $heightinches;
$heightsquared = $trueheight * $trueheight;
$bmi = ($weight / $heightsquared) * 708;

//BMI = 703 x weight / (height in inches)^2

$insert = "INSERT INTO userInfo (firstName, lastName, userName, userEmail, password, "
        . "userHeightF, userHeightI, userWeight, userDOB, userBMI, dateBMI) VALUES"
        . " ('$firstname', '$lastname', '$username', '$useremail', '$userpassword', "
        . "'$heightfeet', '$heightinches', '$weight', '$dob', '$bmi', '$date')";


if ($con->query($insert))
{
    $query = "SELECT * FROM userInfo WHERE userName = '$username'";

    $result = $con->query($query);
    
    while ($row = $result->fetch_assoc())
    {
    $_SESSION['userID'] = $userID;
    $_SESSION['userName'] = $username;
    $_SESSION['firstName'] = $firstname;
    $_SESSION['lastName'] = $lastname;
    $_SESSION['userHeightF'] = $userHeightF;
    $_SESSION['userHeightI'] = $userHeightI;
    $_SESSION['userWeight'] = $userWeight;
    $_SESSION['userBMI'] = $userBMI;
    $_SESSION['dateBMI'] = $dateBMI;
    }

    //redirect to dashboard on successful creation
    header("Location: dashboard.php");

} else
{
    echo "Error: " . $insert . "<br>" . $con->error;
}

//close MSQL connection
mysqli_close($con);
