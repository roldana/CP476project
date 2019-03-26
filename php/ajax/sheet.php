<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    
    if (!isset($_REQUEST['GroupID'])) {
        echo "";
        exit();
    }
    
    include_once("../../functions.php");

    $db = getDB();
    
    $update = false;
    $remove = false;
    $get = "";
    $cell = "";
    $count = 0;
    
    if (isset($_REQUEST['remove']) and isset($_REQUEST['id'])) {
        $remove = deleteUserTime($db, $_REQUEST['GroupID'], $_REQUEST['id'], $_SESSION['UserID']);
    }
    
    if(isset($_REQUEST['update']) and isset($_REQUEST['id'])) {
        $update = insertUserTime($db, $_REQUEST['GroupID'], $_REQUEST['id'], $_SESSION['UserID']);
    }
    
    if(isset($_REQUEST['get']) and isset($_SESSION['UserID'])) {
        $get = retreiveUserCells($db, $_REQUEST['GroupID'], $_SESSION['UserID']);
    }
    
    if (isset($_REQUEST['cell'])) {
        $cell = $_REQUEST['cell'];
        $count = retreiveCellCounts($db, $_REQUEST['GroupID'], $_REQUEST['cell']);
    }
    
    $data = Array('update' => $update, 'remove' => $remove, 'get' => $get, 'cell' =>  $cell, 'count' => $count, );
    
    //print_r ($get);
    echo json_encode($data);
?>