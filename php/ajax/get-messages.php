<?php
    session_start();
    include_once("../../functions.php");
  
    //if $_POST['view'] != '' -> Return list of html elements containing each element
    //                        -> Then make sure those elements are set to 'seen' in db (`stastus` = 1)
    //
    //else:                   -> Only return count   
  
    if(isset($_POST['view'])){
        
        $db = getDB();   
        
        $output = '';
        
        if($_POST["view"] != '') {
            $messages = retreiveMessages($db, $_SESSION['UserID']);
            foreach($messages as $message) {
                $output .= '<li class= "list-group-item m-1" id="'.$message['MsgID'].'">
                                <p>
                                    <strong>'.$message["Subject"].'</strong><br />
                                    <small><em>'.$message["MsgBody"].'</em></small>
                                </p>
                                <div class="float-r">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </div>
                            </li>';
            }
            if ($output == '') {
                $output .= '<li class="m-5" style="list-style-type: none;"><h4 class="font-weight-bold">No Messages Found!</h4></li>';
            }
            updateMessagesRead($db, $_SESSION['UserID']);
        }
        
        $count = countMessagesUnread($db, $_SESSION['UserID'])[0];
        $data = array(
           'output' => $output,
           'unseenMessages'  => $count
        );
        
        echo json_encode($data);
    }
?>