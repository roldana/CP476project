<?php
    session_start();
    
    include_once("../../functions.php");

    $db = getDB();
    
    echo json_encode(searchGroups($db, $_REQUEST['Input']));

?>