<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    if (!removeGroup($db, $_REQUEST['GroupID'])) {
        header('HTTP/1.1 400 Bad Request');
    }
    echo "";
?>