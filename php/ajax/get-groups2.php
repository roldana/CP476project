<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    echo json_encode(retreiveGroupsUser($db, $_SESSION['UserID']));

?>