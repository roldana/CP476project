<?php
    include("../include/header.php");
?>

<div class="content-container">
    <div class="content-wrap">
        <span class="form-title">
            My Account
        </span>
        <h2>Username</h2>
        <p>
        <?php if (!isset($_SESSION['UserName'])) {
            echo " - You're not logged in!";
            }else {
            echo  " - ".$_SESSION['UserName'];}?>
        </p>
        <h2>Email</h2>
        <p>
        <?php if (!isset($_SESSION['Email'])) {
            echo " - You're not logged in!";
            }else {
            echo  " - ".$_SESSION['Email'];}?>
        </p>
        <h2>Affiliation</h2>
        <p>
        <?php if (!isset($_SESSION['Email'])) {
            echo " - You do not have an Affiliation!";
            }else {
            echo  " - ".$_SESSION['Affiliation'];}?>
        </p>
        
        <h2>Current Groups</h2>
        <ul class="list-group m-b-10 m-t-10">
            <li class="list-group-item m-b-10">
                    [Group Name] - [Class name] - [Admin Status]
                    <div class="float-r">
                        <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                        <button class="btn btn-primary" type="submit">Delete Group</button>
                    </div>
                </li>
                <li class="list-group-item m-b-10">
                    [Group Name] - [Class name] -[Admin Status]
                    <div class="float-r">
                        <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                        <button class="btn btn-primary" type="submit">Delete Group</button>
                    </div>
                </li>
                <li class="list-group-item m-b-10">
                    [Group Name] - [Class name]
                    <div class="float-r">
                        <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                        <button class="btn btn-primary" type="submit">Exit Group</button>
                    </div>
                </li>
                <li class="list-group-item m-b-10">
                    [Group Name] - [Class name]
                    <div class="float-r">
                        <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                        <button class="btn btn-primary" type="submit">Exit Group</button>
                    </div>
                </li>
            </ul>
         <a class="btn btn-primary" role="button" href="#">Change Account Information</a>
    </div>
</div>
<?php
    include("../include/footer.php");
?>