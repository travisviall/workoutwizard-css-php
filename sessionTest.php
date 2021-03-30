<?php

session_start();

    require_once 'DBConnect.php';

    $user = "tviall";

    $query = "SELECT * FROM userInfo WHERE userName = '$user'";

    $result = $con->query($query);

    if (!$result)
    {
        echo "Error: " . $select . "<br>" . $con->error;
    } else
    {
        while ($row = $result->fetch_assoc())
        {
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['userHeightF'] = $row['userHeightF'];
            $_SESSION['userHeightI'] = $row['userHeightI'];
            $_SESSION['userWeight'] = $row['userWeight'];
        }
    }

    echo "Hello " . $_SESSION['firstName'] . ", your user name is: " . $_SESSION['userName'] . "<br>";
    echo " Your height is: " . $_SESSION['userHeightF']. "ft " . $_SESSION['userHeightI']. "in<br>";
    echo "You weigh " . $_SESSION['userWeight'] . "lbs";