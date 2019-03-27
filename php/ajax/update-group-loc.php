<?php
    session_start();
    
    include_once '../../include/config.php';
    include '../../functions.php';
    
    if (isset($_REQUEST['Latitude']) && isset($_REQUEST['Longitude']) && isset($_REQUEST['GroupID'])) {
        $db = getDB();
        if (updateGroupLoc($db, $_REQUEST)) {
            echo $_REQUEST['Latitude'];
            echo $_REQUEST['Longitude'];
            echo $_REQUEST['GroupID'];
        } 
        else {
            header('HTTP/1.1 400 Bad Request');
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
    }
?>