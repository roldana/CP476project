<?php
    date_default_timezone_set('America/Toronto');

    session_start();

    include_once("../../functions.php");
  
    if (isset($_REQUEST)) {
        $groupName = $_REQUEST['groupname'];
        $description = $_REQUEST['description'];
        $pass1 = $_REQUEST['pass1'];
        $pass2 = $_REQUEST['pass2'];
        $startDate = $_REQUEST['startdate'];
        $lat = $_REQUEST['lat'];
        $lng = $_REQUEST['lng'];
    }

    $unix = new DateTime($startDate);
    $startDate = $unix->getTimeStamp();
        
    if ($pass1 != $pass2) {
        header("Location: ../create-group.php?err=True");
    }
    
    $hash = password_hash($pass1, PASSWORD_DEFAULT);
    
    $db = getDB();
    
    $insert = insertGroup($db, $groupName, $_SESSION['UserID'] ,$description, $startDate, $hash, $lat, $lng);
       
    if (!$insert) {
        header("Location: ../create-group.php?err=True");
    }
    
    header("Location: ../account.php");
?>