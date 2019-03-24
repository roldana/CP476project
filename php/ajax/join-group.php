<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    if(joinGroup($db, $_REQUEST['GroupID'], $_SESSION['UserID'], $_REQUEST['Password'])) {
       echo "";
    } else {
        header('HTTP/1.1 400 Bad Request');
    }
?>