<?php
session_start();
require_once 'DBConnect.php';

$workoutname = htmlentities(stripslashes(htmlspecialchars($_POST['workOutName'])));
$username = $_SESSION['userName'];
$userID = $_SESSION['userID'];
global $id;

//print the POST array
//print_r($_POST);
//
//add the workout name to the workOuts database table
$insertname = "INSERT INTO workOuts (workOutName) VALUES ('$workoutname')";


if (!$con->query($insertname))
{
    echo "Error: " . $insertname . "<br>" . $con->error;
} else
{
        $query = mysqli_query($con, 'SHOW COLUMNS FROM  workOuts');

    //query to obtain the ID of the workout
    $select = "SELECT idworkOuts FROM workOuts WHERE workOutName = '"
            . htmlentities(stripslashes(htmlspecialchars($workoutname))) . "'";

    $result = $con->query($select);

    if (!$result)
    {
        echo "Error: " . $select . "<br>" . $con->error;
    } else
    {
        while ($row = $result->fetch_assoc())
        {
            //save id value as a global variable
            $id = $row["idworkOuts"];
            //echo $row["idworkOuts"];
        }
    }

    mysqli_query($con, "UPDATE workOuts SET USERNAME = '" . $username . "' WHERE idWorkOuts = " . $id . "");
    mysqli_query($con, "UPDATE workOuts SET UserID = '" . $userID . "' WHERE idWorkOuts = " . $id . "");

//loops through all the column names in the database
    while ($row = mysqli_fetch_object($query))
    {
        foreach ($_POST as $key => $value)
        {
            //if the column name is equal to the value from POST, insert into table
            if ($row->Field == $value)  
            {
                $update = mysqli_query($con, "UPDATE workOuts SET " . htmlentities(stripslashes(htmlspecialchars($value))) . " = '0'"
                        . " WHERE (workOutName ='" . htmlentities(stripslashes(htmlspecialchars($workoutname)))
                        . "' AND idworkOuts ='" . htmlentities(stripslashes(htmlspecialchars($id))) . "')");

                if (!$update)
                {
                    echo "Error: " . $update . "<br>" . $con->error;
                }
            }
        }
        //echo $row->Field . "<br>";
    }
}

header("Location: createworkout.html");

mysqli_close($con);

//loop through POST values
/* foreach ($_POST as $key => $value)
  {
  echo $value . "<br>";
  } */


//get all the column names from the workOuts database table
//$query = mysqli_query($con, "SHOW COLUMNS FROM workOuts");
//get each column name and assign it to $row
/* while($row = mysqli_fetch_object($query))
  {
  foreach(htmlentities(stripslashes(htmlspecialchars($_POST))) as $key => $value)
  {
  //if the column fetched from database matches the POST value, set field in database to 0
  if ($row->Field == $value)
  {

  }
  }
  } */

//loop through the $_POST array and print out the values
/* foreach($_POST as $key => $value)
  {

  echo $value;
  } */

//******************retrieves column names*************************
/* $query = mysqli_query($con, 'SHOW COLUMNS FROM  workOuts');

  while($row = mysqli_fetch_object($query))
  {
  echo $row->Field . "<br>";
  } */
//******************retrieves column names*************************
//
//
//******************retrieves the data from the columns************
/* $query = 'SELECT workOutName FROM workOuts';

  $result = $con->query($query);

  while($row = $result->fetch_assoc()) {
  echo $row["workOutName"] ;

  }
  echo $name; */
//******************retrieves the data from the columns************

