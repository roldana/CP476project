<?php include("../include/header.php"); 

    $timeslots = ['8:00AM', '8:30AM', '9:00AM', '9:30AM', '10:00AM', '10:30AM', '11:00AM', '11:30AM', '12:00PM', '12:30PM', '1:00PM', '1:30PM', '2:00PM', '2:30PM', '3:00PM', '3:30PM', '4:00PM', '4:30PM', '5:00PM', '5:30PM', '6:00PM', '6:30PM', '7:00PM', '7:30PM', '8:00PM', '8:30PM','9:00PM', '9:30PM', '10:00PM', '10:30PM', '11:00PM', '11:30PM'];

    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    include_once("../functions.php");
    
    $db = getDB();
    
    if(!empty($_GET)) {
        if (!verifyGroupAdmin($db, $_SESSION['UserID'], $_GET['GroupID'])) {
            header("Location: account.php");
        }
    } else {
        header("Location: account.php");
    }
    
    $group = retreiveGroupByID($db, $_GET['GroupID']);
?>
<script src="../js/finalize-time.js"></script>

<input class="d-none" id="group-id" value="<?php echo $_GET['GroupID'];?>">
<input class="d-none" id="user-id" value="<?php echo $_SESSION['UserID'];?>">

<div class="content-container">

<div class="content-wrap">
    
    <div class="container-fluid m-1">
        <div class="row">
            <h1 class="col-xl-12"><?php echo $group['GroupName']; ?></h1> </br>
            
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-inverse bg-light border border-secondary rounded">
                    <div class="card-header">
                        <h4>Finalize your group times: </h4>
                    </div>
                    
                    <?php if ($group['Status'] == 0) {?>
                    
                    <div class="card-body table-responsive" style=" overflow-y: scroll; overflow-x: hidden;">
                        <?php
                              $startDate = new DateTime($group['StartDate']);           
                              $day = date("l", $startDate->getTimeStamp());
                              //echo $day;
                              echo '<table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 12.5%;"></th>';
                              for ($i = 0; $i < 7; $i++) {
                                  echo '<th scope="col" style="width: 12.5%;">'.$day.'</th>';
                                  $startDate->modify('+1 day');
                                  $day = date("l", $startDate->getTimeStamp());
                              }
                              echo         '</tr>
                                        </thead>
                                        <tbody>';
                              for ($i = 0; $i < sizeof($timeslots); $i++) {
                                  echo '<tr><th scope="row" class="text-right" style="width: 12.5%;">'.$timeslots[$i].'</th>';
                                  for ($j = 0; $j < 7; $j++) {
                                      echo '<td class="clickable" id="'.$i."-".$j.'"></td>';
                                  }
                                  echo '</tr>'; 
                              }
                              echo     '</tbody>';
                              echo '</table>';
                          ?>
                    </div>
                    <div class="card-footer">
                        <button id="submit-times" type="button" class="btn btn-success btn-lg float-r group-view-btn">Submit Times</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include("../include/footer.php"); ?>
    