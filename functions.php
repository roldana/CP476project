<?php

include_once("include/config.php");

function getDB() {
    $db = null;
    try {
        $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
         if (! $db) {
            throw new Exception("");
        }
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (Exception $e) {
        errorHandler($e->getMessage());
    }
    
    return $db;
}

function retreiveUser($db, $userName) {
    $sth = $db->prepare('SELECT * FROM Users WHERE Username = ?;');
    $sth->execute(array($userName));
    return $sth->fetch();
}

function insertUser($db, $UserName, $Email, $Affiliation, $Pass) {
    try {
        $sth = $db->prepare('INSERT INTO Users ;');
        
        $sql = "INSERT INTO Users (UserID, UserName, Password, Email, Affiliation) VALUES (DEFAULT, ?, ?, ?, ?)";
        
        echo $UserName." ".$Email." ".$Affiliation." ".$Pass;
        
        if (!($db->prepare($sql)->execute([$UserName, $Pass, $Email, $Affiliation]))) {
            errorHandler("could not create user!");
        }
    }
    catch (Exception $e) {
        errorHandler($e->getMessage());
    }
    return True;
}

function errorHandler($errorString) {
    header("Location: error.php?error=".$errorString);
}

?>