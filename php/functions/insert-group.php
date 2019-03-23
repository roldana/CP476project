<?php
    session_start();

    include_once("../../functions.php");
  
    if (isset($_REQUEST)) {
        $groupName = $_REQUEST['groupname'];
        $description = $_REQUEST['description'];
        $pass1 = $_REQUEST['pass1'];
        $pass2 = $_REQUEST['pass2'];
        $startDate = $_REQUEST['startdate'];
        $endDate = $_REQUEST['enddate'];
    }
    
    if (($pass1 != $pass2) or ($endDate < $startDate)) {
        header("Location: ../create-group.php?err=True");
    }
    
    $hash = password_hash($pass1, PASSWORD_DEFAULT);
    
    $db = getDB();
    
    $insert = insertGroup($db, $groupName, $_SESSION['UserID'] ,$description, $startDate, $endDate, $hash);
       
    if (!$insert) {
        header("Location: ../create-group.php?err=True");
    }
    
    header("Location: ../account.php");
?>