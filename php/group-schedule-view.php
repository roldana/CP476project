<?php include("../include/header.php"); 

    include_once("../functions.php");
    
    $db = getDB();
    
    if(!empty($_GET)) {
        if (!verifyGroupUser($db, $_SESSION['UserID'], $_GET['GroupID'])) {
            header("Location: account.php");
        }
    } else {
        header("Location: account.php");
    }
?>
<div class="content-container">

<div class="content-wrap">
    <div class="group-row">
        <h1>Group Name</h1>
        
        <div class="group-row-user-box">
            Username1 (you)
            <div class="group-row-user-box-colour cyan"></div>
        </div>
        <div class="group-row-user-box">
            Username2
            <div class="group-row-user-box-colour blue"></div>
        </div>
        <div class="group-row-user-box">
            Username3
            <div class="group-row-user-box-colour purple"></div>
        </div>
    </div>

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

    <!--  !!!!!!!
     This part will be procedurally generated with php when implemented in the final application
          !!!!!!! -->

    <div class="calendar-container">
        <div class="calendar-day-row">
            <div class="day-row">

            </div>
            <div class="day-row">
                Sunday
            </div>
            <div class="day-row">
                Monday
            </div>
            <div class="day-row">
                Tuesday
            </div>
            <div class="day-row">
                Wednesday
            </div>
            <div class="day-row">
                Thursday
            </div>
            <div class="day-row">
                Friday
            </div>
            <div class="day-row">
                Saturday
            </div>
        </div>

        <div class="time-row">
            <div class="time-box-no-edit">
                9:00 am
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span><span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                9:30 am
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span><span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                10:00 am
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span><span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                10:30 am
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span><span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                11:00 am
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span><span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                11:30 am
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span><span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                12:00 pm
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                12:30 pm
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">
                <span class="purple-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                1:00 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                1:30 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                2:00 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                2:30 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                3:00 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                3:30 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                4:00 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                4:30 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                5:00 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">
                <span class="blue-text">&#x2713;</span>
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
        </div>
        <div class="time-row">
            <div class="time-box-no-edit">
                5:30 pm
            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
            <div class="time-box">

            </div>
        </div>

    </div>


    <div class="submit-button-box">
        <button class="btn btn-outline-success">
            Submit Times
        </button>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="card card-inverse col-md-6 ml-auto">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="row list-group-item">
                            <div class="col-md-10">
                                <p>
                                    <strong>Someone Else</strong>
                                    <small>March 29th, 2019 @ 5:20PM</small> 
                                </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                            dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="row list-group-item">
                            <div class="col-md-10 ml-auto">
                                <p class="text-right">
                                    <small>March 29th, 2019 @ 5:22PM</small>
                                    <strong>(You)</strong> 
                                </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                            dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="row list-group-item">
                            <div class="col-md-10">
                                <p>
                                    <strong>Someone Else</strong>
                                    <small>March 29th, 2019 @ 5:24PM</small>
                                </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                            dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here...">
                        <span class="input-group-btn">
                            <button class="btn btn-success" id="btn-chat">Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<br>

<?php include("../include/footer.php"); ?>