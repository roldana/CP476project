<?php
    session_start();
    
    include_once("../functions.php");

    $db = getDB();
    
    echo json_encode(retreiveGroupsAdmin($db, $_SESSION['UserID']));

?>