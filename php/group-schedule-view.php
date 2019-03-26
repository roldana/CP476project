<?php include("../include/header.php"); 

    $timeslots = ['8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '1:00', '1:30', '2:00', '2:30', '3:00', '3:30', '4:00', '4:30', '5:00', '5:30', '6:00', '6:30', '7:00', '7:30', '8:00', '8:30','9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00'];

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
    
    <div class="container-fluid">
        <div class="group-row">
            <h1><?php echo $group['GroupName']; ?></h1> </br>
        </div>
        <div class="row">
            <div class="col-md-9 card card-inverse bg-light border border-secondary rounded" style="height: 500px;">
                <div class="card-header">
                    <h4><?php echo $group['Description']; ?></h4>
                </div>
                <div class="card-body mt-none" style="max-height: 500px; overflow-y: scroll; overflow-x: hidden;">
                    <?php
                          $startDate = new DateTime($group['StartDate']);           
                          $day = date("l", $startDate->getTimeStamp());
                          //echo $day;
                          echo '<table class="table table-bordered">
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
                              echo '<tr><th scope="row" style="width: 12.5%;">'.$timeslots[$i].'</th>';
                              for ($j = 0; $j < 7; $j++) {
                                  echo '<td></td>';
                              }
                              echo '</tr>'; 
                          }
                          echo     '</tbody>';
                          echo '</table>';
                      ?>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-success">Submit Times</button>
                </div>
            </div>
            
            <div class="card card-inverse ml-2 col border border-secondary rounded"  style="height: 500px;">
                <div class="card-body">
                    <ul class="list-group list-group-flush" id="scroll" style="max-height: 400px; overflow-y: scroll; overflow-x: hidden;">
                       
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input id="text-content" type="text" class="form-control input-sm" placeholder="Type your message here...">
                        <span class="input-group-btn">
                            <button class="btn btn-success" id="send-chat">Send</button>
                        </span>
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

    <div class="container-fluid">
        <div class="row mt-2">
            
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