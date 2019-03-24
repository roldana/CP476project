<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    if (!removeMessage($db, $_REQUEST['MsgID'], $_SESSION['UserID'])) {
        header('HTTP/1.1 400 Bad Request');
    }
    echo "";
?>