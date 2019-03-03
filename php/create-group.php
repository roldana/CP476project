<?php
    include("../include/header.php");
?>

    <div class="content-container">
        <div class="content-wrap">
            <span class="form-title">
                Create a group
            </span>

            <form class="form50" id="create-group-form" method="POST" action="group-list.php">

                <div class="wrap-input">
                    <input class="input-box" type="text" name="groupname" id="groupname" placeholder="Enter a Group Name">
                </div>
                
                <div class="wrap-input">
                    <input class="input-box" type="password" id="pass1" name="pass1" placeholder="Password">
                </div>

                <div class="wrap-input">
                    <input class="input-box" type="password" id="pass1" name="pass2" placeholder="Repeat Password">
                </div>

                <label for="start-date" class="input-label-top">Enter a Start Date:</label>
                <div class="wrap-input">
                    <input class="input-box" type="date" id="startdate" name="startdate" id="start-date">
                </div>

                <label for="start-date" class="input-label-top">Enter an End Date:</label>
                <div class="wrap-input">
                    <input class="input-box" type="date" id="startdate" name="enddate" id="end-date">
                </div>

                <button class="btn btn-outline-success float-r" type="submit">Create Group</button>

            </form>

        </div>
    </div>
    
    <script src="../js/create-group.js"></script>

<?php
    include("../include/footer.php");
?>