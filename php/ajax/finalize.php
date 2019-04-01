<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
            
    if (!finalizeGroup($db, $_REQUEST['GroupID'], $_REQUEST['start'], $_REQUEST['end'])) {
        header('HTTP/1.1 400 Bad Request');
    }
?>