<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
            
    if (!sendChatMessage($db, $_REQUEST['GroupID'], $_REQUEST['UserID'], $_REQUEST['Content'])) {
        header('HTTP/1.1 400 Bad Request');
    }
    
    echo "";
?>