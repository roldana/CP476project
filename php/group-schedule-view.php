<?php include("../include/header.php"); 
    date_default_timezone_set('America/Toronto');

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
    $adminUserName = retreiveUserName($db, $group['AdminID'])[0];
?>
<script src="../js/group-schedule-view.js"></script>
<!-- <script src="../js/calendar-events.js"></script> -->

<input class="d-none" id="msg-count" value="">
<input class="d-none" id="group-id" value="<?php echo $_GET['GroupID'];?>">
<input class="d-none" id="user-id" value="<?php echo $_SESSION['UserID'];?>">

<div class="content-container">

<div class="content-wrap">
    
    <div class="container-fluid m-1">
        <div class="row">
            <h1 class="col-xl-12"><?php echo $group['GroupName']; ?></h1> </br>
            
        </div>
        
        <div class="row">         
        
            <?php if ($group['Status'] == 0) {?>
            <div class="col-xl-7">
                <div class="card card-inverse bg-light border border-secondary rounded" style="height: 700px;">
                    <div class="card-header">
                        <h4>Select when you are available: </h4>
                    </div>
                    
                    <div class="card-body table-responsive" style="max-height: 700px; overflow-y: scroll; overflow-x: hidden;">
                        <?php
                              $startDate = new DateTime();
                              $startDate->setTimeStamp($group['StartDate']);
                              $day = date("M j", $startDate->getTimeStamp());
                              //echo $day;
                              echo '<table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 12.5%;"></th>';
                              for ($i = 0; $i < 7; $i++) {
                                  echo '<th scope="col" style="width: 12.5%;">'.$day.'</th>';
                                  $startDate->modify('+1 day');
                                  $day = date("M j", $startDate->getTimeStamp());
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
                    <?php if ($_SESSION['UserID'] == $group['AdminID']) { ?>
                    <div class="card-footer">
                        <a href="finalize-time.php?GroupID=<?php echo $_GET['GroupID']; ?>" target="_blank" class="btn btn-primary float-r group-view-btn">Finalize Group Time</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <div class="col-xl-2">
                <div class="card card-inverse border border-secondary rounded"  style="height: 700px;">
                    <div class="card-header">
                        <h4>Last Selected Time:</h4>
                        <p id="last-selected"></p>
                    </div>
                    <div class="card-body mx-3" style="overflow: hidden;">
                        <div>
                            <h5 class="font-weight-bold" id="selected"></h5>
                            <ul class="list-group list-group-flush" id="users-selected">
                           
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-xl-9">
                <div class="card card-inverse border border-secondary rounded"  style="height: 700px;">
                    <div class="card-header">
                        <h4>Group Meeting has been finalized: </h4>
                    </div>
                    <div class="card-body mx-3" style="overflow: hidden;">
                        <div>
                            <p><?php $startDate = new DateTime();
                                     $startDate->setTimeStamp($group['FinalStart']);
                                     $day = date("l F jS Y g:iA", $startDate->getTimeStamp());
                                     echo "From ".$day." to "; 
                                     $startDate->setTimeStamp($group['FinalEnd']);
                                     $day = date("l F jS Y g:iA", $startDate->getTimeStamp()); 
                                     echo $day; ?></p>
                            <p>If you have not received a google calendar event, it is likely the Group Admin has yet to push it to google. Message the Group Admin (<?php echo $adminUserName; ?>) as soon as possible to fix.</p>
                            
                        </div>
                    </div>
                    <?php if ($_SESSION['UserID'] == $group['AdminID']) { ?>
                    <div class="card-footer">
                        <a href="finalize-time.php?GroupID=<?php echo $_GET['GroupID']; ?>" target="_blank" class="btn btn-primary float-r group-view-btn">Finalize Group Time</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <div class="col-xl-3">
                <div class="card card-inverse border border-secondary rounded"  style="height: 700px;">
                    <div class="card-body m-3" id="scroll" style="overflow-y: scroll; overflow-x: hidden;">
                        <ul class="list-group list-group-flush" id="chat-window">
                           
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input id="text-content" type="text" class="form-control input-sm" placeholder="Type your message here...">
                            <div class="input-group-btn input-group-append">
                                <button class="btn btn-primary" id="send-chat" type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <h4 class="col-xl-8"><?php echo $group['Description']; ?></h4>            
        </div>
        
        <div class="row mt-4">
            <div class="col-xl-12">
                <p style="font-style: italic; float: right;">(click anywhere on the map to change the location)</p>
                <div id="map" class="col border border-secondary rounded" style="width:100%; height:500px;"></div>
                <script>
                // Initialize and add the map
                function initMap() {
                    // The location of group
                    // var WLU = {lat: 43.4735, lng: -80.5273};
                    var groupLoc = {lat: <?php echo $group['Lat']; ?>, lng: <?php echo $group['Lng']; ?>};
                    var mapOptions = {
                        disableDefaultUI: true,
                        zoomControl: true,
                        zoom: 16,
                        center: groupLoc
                    }
                    // The map, centered at groupLoc
                    var map = new google.maps.Map(
                        document.getElementById('map'), mapOptions);
                    
                    // The marker, positioned at groupLoc
                    var marker = new google.maps.Marker({position: groupLoc, map: map});
                    var markerWindow = new google.maps.InfoWindow({
                        content: "Group location",
                        maxWidth: 200
                    });
                    marker.addListener('click', () => {
                        markerWindow.open(map, marker);
                    });


                    map.addListener('click', (event) => {
                        <?php if ($_SESSION['UserID'] == $group['AdminID']) { ?>
                        let coordinates = {lat: event.latLng.lat(), lng: event.latLng.lng()};
                        var changeLoc = confirm("Change the group location?");
                        if (changeLoc){
                            // deletes old marker
                            marker.setMap(null);

                            var jqxhr = $.post("ajax/update-group-loc.php", {
                                Latitude: event.latLng.lat(),
                                Longitude: event.latLng.lng(),
                                GroupID: $("#group-id").val()
                            })
                            .done(function(data) {
                                console.log("group location updated successfully");
                                marker = new google.maps.Marker({
                                    position: coordinates,
                                    map: map,
                                    title: "Group location"
                                });
                                var newMarkerWindow = new google.maps.InfoWindow({
                                    content: "Group location",
                                    maxWidth: 200
                                });
                                marker.addListener('click', () => {
                                    newMarkerWindow.open(map, marker);
                                });        
                            })
                            .fail(function() {
                                alert( "An error ocurred while updating the location. Try again later" );
                            })
                            .always(function() {
                                //
                            });
                        }
                        <?php } else { ?>
                        alert("You are not the group admin. Send a chat message to suggest a new location.");
                        <?php } ?>

                    });
                }
                </script>
            </div>
        </div>
    </div>

</div>

</div>
<br>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB66pDOAGoYdLv3J8nk6oSD6OVjxPKsXb8&callback=initMap"></script>

<?php include("../include/footer.php"); ?>
