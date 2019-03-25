<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    if (!retreiveUser($db, $_REQUEST['UserName'])) {
        header('HTTP/1.1 400 Bad Request');
    }
    echo "";
?>