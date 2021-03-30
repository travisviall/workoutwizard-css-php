<?php

session_start();

$userID = $_SESSION['userID'];

global $goalName;

require_once "DBConnect.php";

//query to check if user already has goals setup
$queryUser = mysqli_query($con, "SELECT userID FROM USERGOALS WHERE userID ='" . $_SESSION['userID'] . "'");

$count = $queryUser->num_rows;

//if the query does not return any results
if (!$count == 1)
{
    //create a new USERGOALS database entry and add userID to it
    mysqli_query($con, "INSERT INTO USERGOALS (userID) VALUES ('$userID')");
}

//if the userID exists in the USERGOALS database

foreach ($_POST as $key => $value)
{
    $columnName = htmlentities(stripslashes(htmlspecialchars($key)));
    $columnValue = htmlentities(stripslashes(htmlspecialchars($value)));

    $targetWieght = "targetWeight";

    echo $columnName . " " . $columnValue . "<br>";

    if ($columnName == "targetWeight")
    {
        //ensure that submitting a null value will not override existing data
        if ($columnValue > 0)
        {
            mysqli_query($con, "UPDATE USERGOALS SET " . $columnName . " = " . $columnValue . " WHERE userID ='" . $userID . "'");
        }
    }

    if ($columnName == "targetBMI")
    {
        if ($columnValue > 0)
        {
            mysqli_query($con, "UPDATE USERGOALS SET " . $columnName . " = " . $columnValue . " WHERE userID ='" . $userID . "'");
        }
    }

    if ($columnName == "goals")
    {
        //set global variable to goal name
        $goalName = $columnValue;
    }

    if ($columnName == "goalValue")
    {
        //access all columns in database
        $query = mysqli_query($con, 'SHOW COLUMNS FROM  USERGOALS');

        //loop through columns in database
        while ($row = mysqli_fetch_object($query))
        {
            //if goal field name matches column, update column value
            if ($goalName == $row->Field)
            {
                mysqli_query($con, "UPDATE USERGOALS SET " . $goalName . " = " . $columnValue . " WHERE userID ='" . $userID . "'");
            }
        }
    }
}

header("Location: setGoal.php");

/* $userID = $_SESSION['userID'];

  $insertUserID = mysqli_query($con, "INSERT INTO USERGOALS (userID) VALUES ('$userID')");

  if ($insertUserID)
  {
  foreach ($_POST as $key => $value)
  {
  //echo $key . " " . $value . "<br>";
  $columnName = htmlentities(stripslashes(htmlspecialchars($key)));
  $value = htmlentities(stripslashes(htmlspecialchars($value)));

  $targetWeight = "targetWeight";

  if($columnName == $targetWeight)
  {
  mysqli_query($con, "UPDATE USERGOALS SET targetWeight= " . $value );
  }
  $update = "UPDATE USERGOALS SET " . $columnName . " = " . $columnName . " + " . $value . " WHERE USERID ='$userID'";
  //echo $key . "<br>";
  $select = $con->query($update);

  if ($select)
  {
  header("Location: setGoals.php");
  }
  }
  } */
mysqli_close($con);
