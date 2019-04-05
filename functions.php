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

function retreiveEmailsFromGroup($db, $groupID){
    $sth = $db->prepare('SELECT UserID FROM groupusers WHERE GroupID = ?;');
    $sth->execute(array($groupID));
    $userIDs =  $sth->fetchAll();

    $query = "SELECT Email FROM users WHERE UserID=";
    for($x=0; $x< sizeof($userIDs)-1; $x++){
        $query = $query . $userIDs[$x][0] . " OR UserID=";
    }
    $query = $query . $userIDs[sizeof($userIDs)-1][0];

    $sth = $db->prepare($query);
    $sth->execute();

    return $sth->fetchAll();
}

function retreiveUser($db, $userName) {
    $sth = $db->prepare('SELECT * FROM Users WHERE Username = ?;');
    $sth->execute(array($userName));
    return $sth->fetch();
}

function retreiveUserName($db, $userID) {
    $sth = $db->prepare('SELECT UserName FROM Users WHERE UserID = ?;');
    $sth->execute(array($userID));
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
    sendMessage($db, $UserID, "0", "Group Joined!", "You have joined the group \"".$group['GroupName']."\". You can visit this group from the Account page.");
    return True;
}

function retreiveGroupByID($db, $GroupID) {
    $sth = $db->prepare('SELECT * FROM Groups WHERE GroupID = ? ORDER BY GroupName;');
    $sth->execute(array($GroupID));
    return $sth->fetch();
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

function updateMessagesRead($db, $UserID) {
    $sql = "UPDATE Messages SET Status = 1 WHERE Status = 0 AND ToID = ?;;";
    if (!($db->prepare($sql)->execute([$UserID]))) {
        return False;
    }
    return True;
}

function retreiveMessages($db, $UserID) {
    $sth = $db->prepare('SELECT * FROM Messages JOIN Users WHERE Messages.ToID = ? AND Messages.FromID = Users.UserID ORDER BY MsgDate DESC;');
    $sth->execute(array($UserID));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function removeMessage($db, $MsgID, $UserID) {
    $sql = "DELETE FROM Messages WHERE MsgID = ? AND ToID = ?;";
    if (!($db->prepare($sql)->execute([$MsgID, $UserID]))) {
        return False;
    }
    return True;    
}

function sendMessage($db, $ToID, $FromID, $Subject, $MsgBody) {
    if ($FromID == "") {$FromID = "0";}
    try { 
        $sql = "INSERT INTO Messages (MsgID, ToID, FromID, MsgDate, Subject, MsgBody, Status) VALUES (DEFAULT, ?, ?, ?, ?, ?, DEFAULT);";
        $sth = $db->prepare($sql);
        $sth->bindValue(1, $ToID, PDO::PARAM_INT);
        $sth->bindValue(2, $FromID, PDO::PARAM_INT);
        $sth->bindValue(3, time(), PDO::PARAM_INT);
        $sth->bindValue(4, $Subject, PDO::PARAM_STR);
        $sth->bindValue(5, $MsgBody, PDO::PARAM_STR);
        
        if (!($sth->execute())) {
            return False;
        }
    }
    catch (Exception $e) {
        return False;
    }
    return True;
}

function countMessagesUnread($db, $UserID) {
    $sth = $db->prepare("SELECT COUNT(*) FROM Messages WHERE Messages.ToID = ? AND Messages.Status = '0';");
    $sth->execute(array($UserID));
    return $sth->fetch();
}

function retreiveChatTotal($db, $GroupID) {
    $sth = $db->prepare("SELECT MsgTotal FROM ChatIdentifier WHERE GroupID = ?;");
    $sth->execute(array($GroupID));
    return $sth->fetch();
}

function retreiveChatMessages($db, $GroupID) {
    $sth = $db->prepare('SELECT * FROM ChatMessages WHERE ChatMessages.GroupID = ? ORDER BY MsgDate ASC;');
    $sth->execute(array($GroupID));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function sendChatMessage($db, $GroupID, $UserID, $MsgBody) {
    try {
        $db->beginTransaction();
        $sql = "Update ChatIdentifier SET MsgTotal = MsgTotal + 1 WHERE GroupID = ?;";
        $sth = $db->prepare($sql);
        $sth->bindValue(1, $GroupID, PDO::PARAM_INT);
        if (!($sth->execute())) {
            $db->rollback();
            return False;
        }
        
        $sql = "INSERT INTO ChatMessages (GroupID, UserID, Content, MsgDate) VALUES (?, ?, ?, ?);";
        $sth = $db->prepare($sql);
        $sth->bindValue(1, $GroupID, PDO::PARAM_INT);
        $sth->bindValue(2, $UserID, PDO::PARAM_INT);
        $sth->bindValue(3, $MsgBody, PDO::PARAM_STR);
        $sth->bindValue(4, time(), PDO::PARAM_INT);
        
        if (!($sth->execute())) {
            $db->rollback();
            return False;
        }
    }
    catch (Exception $e) {
        $db->rollback();
        echo $e->getMessage();
        return false;
    }
    $db->commit();
    return True;
}

function verifyGroupUser($db, $UserID, $GroupID) {
    $sql = "SELECT * FROM GroupUsers WHERE GroupID = ? AND UserID = ?;";
    $sth = $db->prepare($sql);
    $sth->execute([$GroupID, $UserID]);
    $data = $sth->fetch();
    if ($data) {
        return True;
    }
    return False;
}

function verifyGroupAdmin($db, $UserID, $GroupID) {
    $sql = "SELECT * FROM Groups WHERE GroupID = ? AND AdminID = ?;";
    $sth = $db->prepare($sql);
    $sth->execute([$GroupID, $UserID]);
    $data = $sth->fetch();
    if ($data) {
        return True;
    }
    return False;
}

function leaveGroup($db, $UserID, $GroupID) {
    $sql = "DELETE FROM GroupUsers WHERE GroupID = ? AND UserID = ?;";
    if (!($db->prepare($sql)->execute([$GroupID, $UserID]))) {
        return False;
    }
    
    $sth = $db->prepare('SELECT * FROM Groups WHERE GroupID = ?;');
    $sth->execute(array($GroupID));
    $group = $sth->fetch();
    
    sendMessage($db, $UserID, "0", "Group Left!", "You have left the group \"".$group['GroupName']."\". You can no longer visit this group from the Account page.");
    return True;
}

function removeGroup($db, $GroupID) {
    
    $sth = $db->prepare('SELECT * FROM Groups WHERE GroupID = ?;');
    $sth->execute(array($GroupID));
    $group = $sth->fetch();
    
    $sth = $db->prepare('SELECT * FROM GroupUsers JOIN Users WHERE GroupID = ? AND GroupUsers.UserID = Users.UserID;');
    $sth->execute(array($GroupID));
    $groupUsers = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "DELETE FROM Groups WHERE GroupID = ?;";
    if (!($db->prepare($sql)->execute([$GroupID]))) {
        return False;
    }
    
    foreach($groupUsers as $user) {
        sendMessage($db, $user['UserID'], "0", "Group Deleted!", "The group \"".$group['GroupName']."\" has been deleted. The group can no longer be visited from the Account page nor can it be found through the search bar.");
    }
    
    return True;
}

Function searchGroups($db, $Input) {
    $sth = $db->prepare("SELECT * FROM Groups JOIN Users ON Groups.AdminID=Users.UserID WHERE GroupName LIKE concat( '%', ?, '%') or UserName LIKE concat( '%', ?, '%');");
    $sth->bindValue(1, $Input, PDO::PARAM_STR);
    $sth->bindValue(2, $Input, PDO::PARAM_STR);
    $sth->execute();
    return $sth->fetchAll();
}

function insertUser($db, $UserName, $Email, $Affiliation, $Pass) {
    try { 
        $sql = "INSERT INTO Users (UserID, UserName, Password, Email, Affiliation) VALUES (DEFAULT, ?, ?, ?, ?);";
        $sth = $db->prepare($sql);
        $sth->bindValue(1, $UserName, PDO::PARAM_STR);
        $sth->bindValue(2, $Pass, PDO::PARAM_STR);
        $sth->bindValue(3, $Email, PDO::PARAM_STR);
        $sth->bindValue(4, $Affiliation, PDO::PARAM_STR);
        
        if (!($sth->execute())) {
            return False;
        }
    }
    catch (Exception $e) {
        return False;
    }
    
    sendMessage($db, $UserID, "0", "Welcome!", "Welcome to Calendar! Search for a group using the search bar or create your own on the Join Group page to get started.");
    return True;
}

function insertGroup($db, $groupName, $adminID, $description, $startDate, $hash, $lat, $lng) {
    try {
        $db->beginTransaction();
        
        $sql = "INSERT INTO Groups (GroupID, AdminID, GroupName, Description, Password, StartDate, EndDate, FinalStart, FinalEnd, Lat, Lng, Status) VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, DEFAULT, DEFAULT, ?, ?, DEFAULT);";
        $endDate = $startDate + 604800;

        $sth = $db->prepare($sql);
        $sth->bindValue(1, $adminID, PDO::PARAM_INT);
        $sth->bindValue(2, $groupName, PDO::PARAM_STR);
        $sth->bindValue(3, $description, PDO::PARAM_STR);
        $sth->bindValue(4, $hash, PDO::PARAM_STR);
        $sth->bindValue(5, $startDate, PDO::PARAM_INT);
        $sth->bindValue(6, $endDate, PDO::PARAM_INT);
        $sth->bindValue(7, $lat, PDO::PARAM_STR);
        $sth->bindValue(8, $lng, PDO::PARAM_STR);
        
        if (!($sth->execute())) {
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

        $sql = "INSERT INTO ChatIdentifier (GroupID) VALUES (?);";
        if (!($db->prepare($sql)->execute([$GroupID]))) {
            $db->rollBack();
            return False;
        } 
        
        $db->commit();
        sendMessage($db, $adminID, "0", "Group Created!", "Your group \"".$groupName."\" has been created. You can visit your group from the Account page.");
    }
    catch (Exception $e) {
        return False;
        errorHandler($e->getMessage());
    }
    return True;
}

function finalizeGroup($db, $GroupID, $start, $end) {
    try {
        $sql = "UPDATE Groups SET FinalStart = ?, FinalEnd = ?, Status = 1 WHERE GroupID = ?;";
        $sth = $db->prepare($sql);
        $sth->bindValue(1, $start, PDO::PARAM_INT);
        $sth->bindValue(2, $end, PDO::PARAM_INT);
        $sth->bindValue(3, $GroupID, PDO::PARAM_INT);
        if (!($sth->execute())) {
            return False;
        }
    }
    catch (Exception $e) {
        errorHandler($e->getMessage());
        return false;
    }
    $sth = $db->prepare('SELECT * FROM GroupUsers JOIN Users WHERE GroupID = ? AND GroupUsers.UserID = Users.UserID;');
    $sth->bindValue(1, $GroupID, PDO::PARAM_INT);
    $sth->execute();
    $groupUsers = $sth->fetchAll(PDO::FETCH_ASSOC);
    
    $sth = $db->prepare('SELECT * FROM Groups WHERE GroupID = ?;');
    $sth->bindValue(1, $GroupID, PDO::PARAM_INT);
    $sth->execute();
    $group = $sth->fetch();
    
    foreach($groupUsers as $user) {
        sendMessage($db, $user['UserID'], "0", "Group Finalized!", "The group \"".$group['GroupName']."\" has been finalized. Check your google calendar and the group page for details. If you do not see anything in your google calendar, contact your group admin ASAP.");
    }
    
    return true;
    
}

function updateUser($db, $data, $UserName) {
    try {
        if (isset($data['Affiliation'])) {
            $sql = "UPDATE Users SET Affiliation = ? WHERE UserID = ?;";
            $sth = $db->prepare($sql);
            $sth->bindValue(1, $data['Affiliation'], PDO::PARAM_STR);
            $sth->bindValue(2, $UserName, PDO::PARAM_STR);
            if (!($sth->execute())) {
                return False;
            }
           $_SESSION['Affiliation'] = $data['Affiliation'];
        } elseif (isset($data['Email'])){
            $sql = "UPDATE Users SET Email = ? WHERE UserID = ?;";
            $sth = $db->prepare($sql);
            $sth->bindValue(1, $data['Email'], PDO::PARAM_STR);
            $sth->bindValue(2, $UserName, PDO::PARAM_STR);
            if (!($sth->execute())) {
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
    
    sendMessage($db, $UserName, "0", "Your account details have changed.", "Your account details have changed. Check them on the Account page to verify the information is correct.");
    return true;
}

function updateGroupLoc($db, $data) {
    try {
        $sql = "UPDATE Groups SET Lat = ?, Lng = ? WHERE GroupID = ?;";
        if (!($db->prepare($sql)->execute([$data['Latitude'], $data['Longitude'], $data['GroupID']]))) {
            return False;
        }
    }
    catch(Exception $e) {
        errorHandler($e->getMessage());
    }
    
    return true;
}

function deleteUserTime($db, $GroupID, $Cell, $UserID) {
    $sql = "DELETE FROM Sheets WHERE GroupID = ? AND Cell = ? AND UserID = ?;";
    return $db->prepare($sql)->execute([$GroupID, $Cell, $UserID]);
}

function insertUserTime($db, $GroupID, $Cell, $UserID) {
    try { 
        $sql = "INSERT INTO Sheets (GroupID, Cell, UserID) VALUES (?, ?, ?);";
        
        if (!($db->prepare($sql)->execute([$GroupID, $Cell, $UserID]))) {
            return False;
        }
    }
    catch (Exception $e) {
        return False;
    }
    return True;
}

function retreiveUserCells($db, $GroupID, $UserID) {
    $sth = $db->prepare('SELECT * FROM Sheets WHERE GroupID = ? AND UserID = ?;');
    $sth->execute(array($GroupID, $UserID));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function retreiveCellCounts($db, $GroupID, $Cell) {
    $sth = $db->prepare('SELECT COUNT(*) FROM Sheets WHERE GroupID = ? AND Cell = ?;');
    $sth->execute(array($GroupID, $Cell));
    return $sth->fetch(PDO::FETCH_ASSOC);
}

function retreiveUsersCell($db, $GroupID, $Cell) {
    $sth = $db->prepare('SELECT * FROM Sheets JOIN Users ON Users.UserID = Sheets.UserID WHERE GroupID = ? AND Cell = ?;');
    $sth->execute(array($GroupID, $Cell));
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function retreiveGroupTotalUsers($db, $GroupID) {
    $sth = $db->prepare('SELECT COUNT(*) FROM GroupUsers WHERE GroupID = ?;');
    $sth->execute(array($GroupID));
    return $sth->fetch(PDO::FETCH_ASSOC);
}

function errorHandler($errorString) {
    if (strpos($a, 'are') == false) {
        header("Location: ../error.php?error=".$errorString);
    } else {
        header("Location: error.php?error=".$errorString);
    }
}

?>
