<?php
session_start();

require_once "DBConnect.php";

echo $_SESSION['workOutName'] . "<br>";

foreach ($_POST as $key => $value)
{
    echo $key . " " . $value . "<br>";
    
    $columnName = htmlentities(stripslashes(htmlspecialchars($key)));
    $value = htmlentities(stripslashes(htmlspecialchars($value)));    
    
    $update = "UPDATE workOuts SET " . $columnName . " = " . $columnName . " + " . $value . " WHERE workOutName ='". $_SESSION['workOutName'] 
                    . "' AND USERNAME ='" . $_SESSION['userName'] . "'";
    
    //echo $key . "<br>";
    
    $select = $con->query($update);
    
    if ($select)
    {
        header("Location: existingworkouts.php");
    }
}

mysqli_close($con);