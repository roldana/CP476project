<?php include("../include/header.php"); ?>

<body>
<p id="signin">Sign into your Google account to access Google Calendar</p>
<button class="btn btn-success float-l" id="authorize_button" style="display: none;">Google Sign In</button>

<p id="signout" style="display: none;">Events created</p>
<button onclick="window.open('', '_self', ''); window.close();" class="btn btn-success float-l" id="signout_button" style="display: none;">Sign Out</button>
<br>
<br>
<iframe id="calFrame" style="display: none;" src="https://calendar.google.com/calendar/embed?src=cp476project%40gmail.com&ctz=America%2FToronto" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>

<pre id="content" style="white-space: pre-wrap;"></pre>

<script src="https://apis.google.com/js/api.js"></script>
<script type="text/javascript">
    var CLIENT_ID = '467375927024-3lcl0fhv0u4thk2r3dpqno9n710tar13.apps.googleusercontent.com';
    var API_KEY = 'AIzaSyAQ8mAvGVnkbJOulP-ZcG7ZX0N93wIt3P0';
    var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];
    var SCOPES = "https://www.googleapis.com/auth/calendar.events";

    var signinMessage = document.getElementById('signin');
    var signoutMessage = document.getElementById('signout');
    var authorizeButton = document.getElementById('authorize_button');
    var signoutButton = document.getElementById('signout_button');
    var calendarFrame = document.getElementById('calFrame');

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
            signoutButton.onclick = handleSignoutClick;
        }, function(error) {
            appendPre(JSON.stringify(error, null, 2));
        });
    }

    function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
            signinMessage.style.display = 'none';
            authorizeButton.style.display = 'none';

            signoutButton.style.display = 'block';
            signoutMessage.style.display = 'block';
            createEvent();
            calendarFrame.style.display = 'block';
        } else {
            authorizeButton.style.display = 'block';
            signoutButton.style.display = 'none';
            signoutMessage.style.display = 'none';
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
            'summary': 'Group meetings',
            'location': '800 Howard St., San Francisco, CA 94103',
            'description': 'This is when your group has decided to meet',
            'start': {
                'dateTime': '2019-03-26T09:00:00-07:00',
                'timeZone': 'EST'
            },
            'end': {
                'dateTime': '2019-03-26T17:00:00-07:00',
                'timeZone': 'EST'
            },
            'recurrence': [
                'RRULE:FREQ=DAILY;COUNT=2'
            ],
            'attendees': [
                {'email': 'infinitysquaredmusic@gmail.com'},
                {'email': 'cp476project@gmail.com.com'}
            ],
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
</body>

<?php include("../include/footer.php"); ?>  
