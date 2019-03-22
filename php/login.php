<?php

session_start();

include_once("../functions.php");


if ( !isset($_REQUEST['username'], $_REQUEST['pass']) ) {
	   header("Location: ../index.php");
     exit();
}

$UserName = $_REQUEST['username'];
$password = $_REQUEST['pass'];

$db = getDB();

$user = retreiveUser($db, $UserName);

if ($user && password_verify($password, $user['Password'])) {  
    $_SESSION['LoggedIn'] = True;
    $_SESSION['UserName'] = $UserName;
    $_SESSION['Affiliation'] = $user['Affiliation'];
    $_SESSION['Email'] = $user['Email'];
    $_SESSION['UserID'] = $user['UserID'];
    header("Location: account.php");
} else {
    header("Location: ../index.php?err=True");
}





?>