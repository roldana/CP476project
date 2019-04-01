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
                        <button id="submit-times" type="button" class="btn btn-success btn-lg float-r group-view-btn">Submit Times</button>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <br>
        <iframe id="calFrame" style="display: none;" src="https://calendar.google.com/calendar/embed?src=cp476project%40gmail.com&ctz=America%2FToronto" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
</div>
</div>

<!-- <p id="signin">Sign into your Google account to access Google Calendar</p>
<button class="btn btn-success float-l" id="authorize_button" style="display: none;">Google Sign In</button> -->

<?php
echo '<p id ="groupName" style="display: none;">' . $group['GroupName'] . "</p>";
echo '<p id ="description" style="display: none;">' . $group['Description'] . "</p>";

echo '<p id ="finalStart" style="display: none;">' . $group['FinalStart'] . "</p>";
echo '<p id ="finalEnd" style="display: none;">' . $group['FinalEnd'] . "</p>";

// Get the user's emails
$userEmails = retreiveEmailsFromGroup($db, $_GET['GroupID']);
$i = 0;
foreach($userEmails as $x){
    echo '<p id ="userEmail' . $i . '"' . 'style="display: none;">' . $x[0] . "</p>";
    $i++;
}
echo '<p id ="i" style="display: none;">' . $i . "</p>";
?>

<script src="https://apis.google.com/js/api.js"></script>
<script type="text/javascript">
    var CLIENT_ID = '467375927024-3lcl0fhv0u4thk2r3dpqno9n710tar13.apps.googleusercontent.com';
    var API_KEY = 'AIzaSyAQ8mAvGVnkbJOulP-ZcG7ZX0N93wIt3P0';
    var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];
    var SCOPES = "https://www.googleapis.com/auth/calendar.events";

    var authorizeButton = document.getElementById('submit-times');
    var calendarFrame = document.getElementById('calFrame');

    var groupName = document.getElementById('groupName').innerHTML;
    var description = document.getElementById('description').innerHTML;

    var finalStart = document.getElementById('finalStart').innerHTML;
    var finalEnd = document.getElementById('finalEnd').innerHTML;

    var emails = [];
    for(var x=0; x<document.getElementById('i').innerHTML; x++){
        var email = document.getElementById("userEmail" + x).innerHTML;

        var emailDict = {
            email: email
        }
        emails.push(emailDict);
    }

    console.log(emails);

    function handleClientLoad() {
        gapi.load('client:auth2', initClient);
    }
    function initClient() {
        gapi.client.init({
            apiKey: API_KEY,
            clientId: CLIENT_ID,
            discoveryDocs: DISCOVERY_DOCS,
            scope: SCOPES
        }).then(function () {
            gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);
            updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
            authorizeButton.onclick = handleAuthClick;
        }, function(error) {
            appendPre(JSON.stringify(error, null, 2));
        });
    }

    function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
            //signinMessage.style.display = 'none';
            authorizeButton.style.display = 'none';
            createEvent();
            calendarFrame.style.display = 'block';
        } else {
            authorizeButton.style.display = 'block';
            calendarFrame.style.display = 'none';
        }
    }

    function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
    }

    function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
    }

    function appendPre(message) {
        var pre = document.getElementById('content');
        var textContent = document.createTextNode(message + '\n');
        pre.appendChild(textContent);
    }

    function createEvent() {

        var event = {
            'summary': groupName + ' Meeting',
            'description': description,
            'start': {
                'dateTime': '2019-03-31T09:00:00-07:00',
                'timeZone': 'EST'
            },
            'end': {
                'dateTime': '2019-03-31T17:00:00-07:00',
                'timeZone': 'EST'
            },
            'attendees': emails,
            'reminders': {
                'useDefault': false,
                'overrides': [
                    {'method': 'email', 'minutes': 24 * 60},
                    {'method': 'popup', 'minutes': 10}
                ]
            }
        };

        var request = gapi.client.calendar.events.insert({
            'calendarId': 'primary',
            'resource': event
        });

        request.execute(function(event) {

        });

    }

</script>

<script async defer src="https://apis.google.com/js/api.js"
        onload="this.onload=function(){};handleClientLoad()"
        onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>


<?php include("../include/footer.php"); ?>
    
