<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    $ToID = retreiveUser($db, $_REQUEST['To'])['UserID'];
        
    if (!sendMessage($db, $ToID, $_SESSION['UserID'], $_REQUEST['Subject'], $_REQUEST['Body'])) {
        header('HTTP/1.1 400 Bad Request');
    }
    
    echo "";
?>