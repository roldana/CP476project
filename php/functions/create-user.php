<?php

    session_start();

    include_once("../../functions.php");

    //TODO: Error checking, check if user exists
    
    $UserName = $_REQUEST['username'];
    $Email = $_REQUEST['email'];
    $Affiliation = $_REQUEST['affiliation'];
    $pass1 = $_REQUEST['pass1'];
    $pass2 = $_REQUEST['pass2'];
    $agree = $_REQUEST['email'];
    
    if (($pass1 != $pass2) or !$agree) {
        header("Location: ../sign-up.php?err=True");
    }
    
    $hash = password_hash($pass1, PASSWORD_DEFAULT);
    
    $db = getDB();
    
    $insert = insertUser($db, $UserName, $Email, $Affiliation, $hash);
    
    if ($insert) {
        $user = retreiveUser($db, $UserName);
    
        $_SESSION['LoggedIn'] = True;
        $_SESSION['UserName'] = $UserName;
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['Affiliation'] = $Affiliation;
        $_SESSION['Email'] = $Email;
        header("Location: ../account.php");
    } else {
        header("Location: ../sign-up.php?err=True&UserName=".$UserName);
    }
    
?>