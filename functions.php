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

Function joinGroup($db, $GroupID, $UserID, $Password) {
    $sth = $db->prepare('SELECT * FROM Groups WHERE GroupID = ?;');
    $sth->execute(array($GroupID));
    $group = $sth->fetch();
    
    if (!isset($group) or empty($group)) {
        return False;
    }
    
    $hash = $group['Password'];
    
    if (!password_verify($Password, $hash)) {
        return False;
    }
    
    $sql = "INSERT INTO GroupUsers (GroupID, UserID) VALUES (?, ?);";
    if (!($db->prepare($sql)->execute([$GroupID, $UserID]))) {
        return False;
    }
    
    return True;
}

function retreiveGroupsAdmin($db, $UserID) {
    $sth = $db->prepare('SELECT * FROM Groups WHERE AdminID = ? ORDER BY GroupName;');
    $sth->execute(array($UserID));
    return $sth->fetchAll();
}

function retreiveGroupsUser($db, $UserID) {
    $sth = $db->prepare('SELECT * FROM Groups JOIN GroupUsers ON Groups.GroupID = GroupUsers.GroupID WHERE Groups.AdminID <> ? AND GroupUsers.UserID = ? ORDER BY GroupName;');
    $sth->execute(array($UserID, $UserID));
    return $sth->fetchAll();
}

function leaveGroup($db, $UserID, $GroupID) {
    $sql = "DELETE FROM GroupUsers WHERE GroupID = ? AND UserID = ?;";
    if (!($db->prepare($sql)->execute([$GroupID, $UserID]))) {
        return False;
    }
    return True;
}

function removeGroup($db, $GroupID) {
    $sql = "DELETE FROM Groups WHERE GroupID = ?;";
    if (!($db->prepare($sql)->execute([$GroupID]))) {
        return False;
    }
    return True;
}

Function searchGroups($db, $Input) {
    $sth = $db->prepare("SELECT * FROM Groups JOIN Users ON Groups.AdminID=Users.UserID WHERE GroupName LIKE concat( '%', ?, '%') or UserName LIKE concat( '%', ?, '%');");
    $sth->execute(array($Input, $Input));
    return $sth->fetchAll();
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

