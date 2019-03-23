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

function retreiveGroupsAdmin($db, $UserID) {
    $sth = $db->prepare('SELECT * FROM Groups WHERE AdminID = ? ORDER BY GroupName;');
    $sth->execute(array($UserID));
    return $sth->fetchAll();
}

function removeGroup($db, $GroupID) {
    $sql = "DELETE FROM Groups WHERE GroupID = ?;";
    if (!($db->prepare($sql)->execute([$GroupID]))) {
        return False;
    }
    return True;
}

function insertUser($db, $UserName, $Email, $Affiliation, $Pass) {
    try { 
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

function insertGroup($db, $groupName, $adminID, $description, $startDate, $endDate, $hash) {
    try {
        $db->beginTransaction();
        
        $sql = "INSERT INTO Groups (GroupID, AdminID, GroupName, Description, Password, StartDate, EndDate) VALUES (DEFAULT, ?, ?, ?, ?, ?, ?);";
        
        if (!($db->prepare($sql)->execute([$adminID, $groupName, $description, $hash, $startDate, $endDate]))) {
            $db->rollBack();
            return False;
        }
        
        $sth = $db->prepare('SELECT * FROM Groups WHERE GroupName = ?;');
        $sth->execute(array($groupName));
        $GroupID = $sth->fetch()['GroupID'];
        
        $sql = "INSERT INTO GroupUsers (GroupID, UserID) VALUES (?, ?);";
        if (!($db->prepare($sql)->execute([$GroupID, $adminID]))) {
            $db->rollBack();
            return False;
        }     
        $db->commit();
    }
    catch (Exception $e) {
        return False;
        errorHandler($e->getMessage());
    }
    return True;
}

function updateUser($db, $data, $UserName) {
    try {
        if (isset($data['Affiliation'])) {
            $sql = "UPDATE Users SET Affiliation = ? WHERE Username = ?;";
            if (!($db->prepare($sql)->execute([$data['Affiliation'], $UserName]))) {
                return False;
            }
           $_SESSION['Affiliation'] = $data['Affiliation'];
        } elseif (isset($data['Email'])){
            $sql = "UPDATE Users SET Email = ? WHERE Username = ?;";
            if (!($db->prepare($sql)->execute([$data['Email'], $UserName]))) {
                return False;
            }
            $_SESSION['Email'] = $data['Email'];
        } else {
            return False;
        }
    }
    catch(Exception $e) {
        errorHandler($e->getMessage());
    }
    return true;
}

function errorHandler($errorString) {
    header("Location: error.php?error=".$errorString);
}

?>

