<?php

session_start();

require_once "DBConnect.php";

$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT Pushups FROM USERGOALS WHERE userID = '" . $_SESSION['userID'] . "'"));
$pushups = 25 / $row['Pushups'] * 10;

echo "Value: " . $pushups;




/*$_SESSION['userID'] = $userID;
    $_SESSION['userName'] = $username;
    //$_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstname;
    $_SESSION['lastName'] = $lastname;
    $_SESSION['userHeightF'] = $userHeightF;
    $_SESSION['userHeightI'] = $userHeightI;
    $_SESSION['userWeight'] = $userWeight;
    $_SESSION['userBMI'] = $userBMI;
    $_SESSION['dateBMI'] = $dateBMI;*/
    


