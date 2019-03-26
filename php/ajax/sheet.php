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
    $total = 0;
    
    if (isset($_REQUEST['remove']) and $_REQUEST['remove'] != '' and isset($_REQUEST['cell']) and $_REQUEST['cell'] != '') {
        $cell = $_REQUEST['cell'];
        $remove = deleteUserTime($db, $_REQUEST['GroupID'], $_REQUEST['cell'], $_SESSION['UserID']);
    }
    
    if(isset($_REQUEST['update'])  and $_REQUEST['update'] != ''and isset($_REQUEST['cell']) and $_REQUEST['cell'] != '') {
        $cell = $_REQUEST['cell'];
        $update = insertUserTime($db, $_REQUEST['GroupID'], $_REQUEST['cell'], $_SESSION['UserID']);
    }
    
    if(isset($_REQUEST['get'])  and $_REQUEST['get'] != '' and isset($_SESSION['UserID'])) {
        $get = retreiveUserCells($db, $_REQUEST['GroupID'], $_SESSION['UserID']);
    }
    
    if (isset($_REQUEST['cell'])  and $_REQUEST['cell'] != '') {
        $cell = $_REQUEST['cell'];
        $count = retreiveCellCounts($db, $_REQUEST['GroupID'], $_REQUEST['cell']);
        $total = retreiveGroupTotalUsers($db, $_REQUEST['GroupID']);
    }
    
    $data = Array('update' => $update, 'remove' => $remove, 'get' => $get, 'cell' =>  $cell, 'count' => $count['COUNT(*)'], 'total' => $total['COUNT(*)']);
    
    //print_r ($get);
    echo json_encode($data);
?>