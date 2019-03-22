<?php
    session_start();
    
    include_once '../include/config.php';
    include '../functions.php';
    
    if (isset($_REQUEST['Affiliation'])) {
        $db = getDB();
        if (updateUser($db, $_REQUEST, $_SESSION['UserName'])) {
            echo $_REQUEST['Affiliation'];
        } 
        else {
            header('HTTP/1.1 400 Bad Request');
        }
    }
    else if (isset($_REQUEST['Email'])) {
        $db = getDB();
        if (updateUser($db, $_REQUEST, $_SESSION['UserName'])) {
            echo $_REQUEST['Email'];
        } 
        else {
            echo "shit";
            //header('HTTP/1.1 400 Bad Request');
        }
    } 
    else {
        header('HTTP/1.1 400 Bad Request');
    }
?>