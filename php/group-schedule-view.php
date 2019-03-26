<?php include("../include/header.php"); 

    $timeslots = ['8:00AM', '8:30AM', '9:00AM', '9:30AM', '10:00AM', '10:30AM', '11:00AM', '11:30AM', '12:00PM', '12:30PM', '1:00PM', '1:30PM', '2:00PM', '2:30PM', '3:00PM', '3:30PM', '4:00PM', '4:30PM', '5:00PM', '5:30PM', '6:00PM', '6:30PM', '7:00PM', '7:30PM', '8:00PM', '8:30PM','9:00PM', '9:30PM', '10:00PM', '10:30PM', '11:00PM', '11:30PM'];

    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    include_once("../functions.php");
    
    $db = getDB();
    
    if(!empty($_GET)) {
        if (!verifyGroupUser($db, $_SESSION['UserID'], $_GET['GroupID'])) {
            header("Location: account.php");
        }
    } else {
        header("Location: account.php");
    }
    
    $group = retreiveGroupByID($db, $_GET['GroupID']);
?>
<script src="../js/group-schedule-view.js"></script> 

<input class="d-none" id="msg-count" value="">
<input class="d-none" id="group-id" value="<?php echo $_GET['GroupID'];?>">
<input class="d-none" id="user-id" value="<?php echo $_SESSION['UserID'];?>">

<div class="content-container">

<div class="content-wrap">
    
    <div class="container-fluid m-1">
        <div class="group-row">
            <h1><?php echo $group['GroupName']; ?></h1> </br>
        </div>
        <div class="row">
            <div class="col-xl-9 card card-inverse bg-light border border-secondary rounded m-1" style="height: 700px;">
                <div class="card-header">
                    <h4><?php echo $group['Description']; ?></h4>
                </div>
                
                <?php if ($group['Status'] == 0) {?>
                
                <div class="card-body table-responsive" style="max-height: 700px; overflow-y: scroll; overflow-x: hidden;">
                    <?php
                          $startDate = new DateTime($group['StartDate']);           
                          $day = date("l", $startDate->getTimeStamp());
                          //echo $day;
                          echo '<table class="table table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 12.5%;"></th>';
                          for ($i = 0; $i < 7; $i++) {
                              echo '<th class="text-center" scope="col" style="width: 12.5%;">'.$day.'</th>';
                              $startDate->modify('+1 day');
                              $day = date("l", $startDate->getTimeStamp());
                          }
                          echo         '</tr>
                                    </thead>
                                    <tbody>';
                          for ($i = 0; $i < sizeof($timeslots); $i++) {
                              echo '<tr><th scope="row" class="text-right" style="width: 12.5%;">'.$timeslots[$i].'</th>';
                              for ($j = 0; $j < 7; $j++) {
                                  echo '<td class="clickable text-center" id="'.$i."-".$j.'"></td>';
                              }
                              echo '</tr>'; 
                          }
                          echo     '</tbody>';
                          echo '</table>';
                      ?>
                </div>
                <?php if ($_SESSION['UserID'] == $group['AdminID']) { ?>
                <div class="card-footer">
                    <button class="btn btn-success float-r">Finalize Times</button>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
            
            <div class="col card card-inverse border border-secondary rounded m-1"  style="max-height: 700px;">
                <div class="card-body m-1 mt-5" id="scroll" style="overflow-y: scroll; overflow-x: hidden;">
                    <ul class="list-group list-group-flush">
                       
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input id="text-content" type="text" class="form-control input-sm" placeholder="Type your message here...">
                        <div class="input-group-btn input-group-append">
                            <button class="btn btn-success" id="send-chat" type="submit">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!--
    <div class="viewButtonBox">

        <div class="viewButton">
            <button class="btn btn-primary btn-lg">
                Week View
            </button>
        </div>

        <div class="viewButton">
            <button class="btn btn-primary btn-lg">
                Month View
            </button>
        </div>

        <div class="viewButton">
            <a class="btn btn-primary btn-lg" href="calendar-view.php">
                Google Calendar
            </a>
        </div>
    </div>
    -->
    <!--  !!!!!!!
     This part will be procedurally generated with php when implemented in the final application
          !!!!!!! -->

    <div class="container-fluid m-1">
        <div class="row">
            
            <div id="map" class="col border border-secondary rounded" style="width:100%; height:500px;"></div>
            <script>
            // Initialize and add the map
            function initMap() {
                // The location of group
                var groupLoc = {lat: <?php echo $group['Lat'];?>, lng: <?php echo $group['Lng'];?>};
                var mapOptions = {disableDefaultUI: true, zoom: 16, center: groupLoc}
                // The map, centered at groupLoc
                var map = new google.maps.Map(
                    document.getElementById('map'), mapOptions);
                
                // The marker, positioned at groupLoc
                var marker = new google.maps.Marker({position: groupLoc, map: map});
            }
            </script>
        </div>
    </div>
</div>

</div>
<br>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB66pDOAGoYdLv3J8nk6oSD6OVjxPKsXb8&callback=initMap"></script>


<?php include("../include/footer.php"); ?>