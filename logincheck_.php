<?php
session_start();

//php variables from form input
$username = htmlentities(stripslashes(htmlspecialchars($_POST['userName'])));
$password = htmlentities(stripslashes(htmlspecialchars($_POST['password'])));

//hash out pw
$hashed = hash("ripemd128", $password);


require_once 'DBConnect.php';

$select = "SELECT * FROM userInfo WHERE userName='$username' and password='$hashed'";

$result = $con->query($select);

if (!$result)
{
    echo "Error: " . $select . "<br>" . $con->error;
}

while ($row = $result->fetch_assoc())
{
    //variables to obtain data from the select query for the account
    $firstname = $row['firstName'];
    $lastname = $row['lastName'];
    $userID = $row['userID'];
    $userHeightF = $row['userHeightF'];
    $userHeightI = $row['userHeightI'];
    $userWeight = $row['userWeight'];
    $userBMI = $row['userBMI'];
    $dateBMI = $row['dateBMI'];
}

$count = $result->num_rows;

//check to make sure mysql query returns only 1 row
if ($count == 1)
{

    $_SESSION['userID'] = $userID;
    $_SESSION['userName'] = $username;
    //$_SESSION['password'] = $password;
    $_SESSION['firstName'] = $firstname;
    $_SESSION['lastName'] = $lastname;
    $_SESSION['userHeightF'] = $userHeightF;
    $_SESSION['userHeightI'] = $userHeightI;
    $_SESSION['userWeight'] = $userWeight;
    $_SESSION['userBMI'] = $userBMI;
    $_SESSION['dateBMI'] = $dateBMI;

    //direct to dashboard.php if $username and $password match mysql query
    //header("Location:dashboard.php");

    header("Location:dashboard.php");
} else
{
    //direct to invalidlogin.php if mysql query returns 0 or 2+ rows
    header("Location:invalidlogin.html");
    //$_SESSION['badPass'] ++;
}

mysqli_close($con);
