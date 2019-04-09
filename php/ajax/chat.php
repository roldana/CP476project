<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    
    date_default_timezone_set('America/Toronto');
    
    include_once("../../functions.php");
  
    //if $_POST['view'] != '' -> Return list of html elements containing each element
    //                        -> Then make sure those elements are set to 'seen' in db (`stastus` = 1)
    //
    //else:                   -> Only return count   
  
    if(isset($_POST['view'])){
        
        $db = getDB();        
        $output = '';
        
        $count = retreiveChatTotal($db, $_REQUEST['GroupID'])[0];
        
        if($_POST["view"] != '') {
            $messages = retreiveChatMessages($db, $_REQUEST['GroupID']);
            foreach($messages as $message) {
                
                $message['UserName'] = retreiveUserName($db, $message['UserID'])[0];
                
                if ($message['UserID'] != $_SESSION['UserID']) {
                    $output .= '<li class="row list-group-item">
                                    <div class="col-md-10">
                                        <p>
                                            <strong>'.$message['UserName'].'</strong></br>
                                            <small>'.date("l F jS h:i A", $message["MsgDate"]).'</small>
                                        </p>
                                        <p>'.$message['Content'].'
                                        </p>
                                    </div>
                                </li>';
                } else {
                    $output .= '<li class="row list-group-item">
                                    <div class="col-md-10 ml-auto">
                                        <p class="text-right">
                                            <strong>'.$message['UserName'].'</strong> </br>
                                            <small>'.date("l F jS h:i A", $message["MsgDate"]).'</small>

                                        </p>
                                        <p class="text-right">'.$message['Content'].'
                                        </p>
                                    </div>
                                </li>';
                }
            }
            if ($output == '') {
                $output .= '<listyle="list-style-type: none;"><h4 class="font-weight-bold">Start Chatting!</h4></li>';
            }
        }
        
        $data = array(
           'output' => $output,
           'messageCount'  => $count
        );
        
        echo json_encode($data);
    }
?>