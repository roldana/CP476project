<?php
    include("../include/header.php");
?>

    <div class="content-container">
        <div class="content-wrap">
            <span class="form-title">
                Create a group
            </span>

            <form class="form50" id="create-group-form" method="POST" action="functions/insert-group.php">

                <div class="wrap-input">
                    <input class="input-box" type="text" name="groupname" id="groupname" placeholder="Enter a Group Name">
                </div>
                
                <div class="wrap-input">
                    <textarea class="input-area" style="resize: none;" rows="4" name="description" id="description" placeholder="Description"></textarea>
                    <div class="word-counter input-box">0/250</div>
                </div>
                
                <div class="wrap-input">
                    <input class="input-box" type="password" id="pass1" name="pass1" placeholder="Password">
                </div>

                <div class="wrap-input">
                    <input class="input-box" type="password" id="pass2" name="pass2" placeholder="Repeat Password">
                </div>

                <label for="start-date" class="input-label-top">Enter a Start Date (End Date will be 7 days from Start Date):</label>
                <div class="wrap-input">
                    <input class="input-box" type="date" id="startdate" name="startdate" id="start-date">
                </div>

                <button class="btn btn-outline-success float-r" type="submit">Create Group</button>

            </form>

        </div>
    </div>
    
    <script src="../js/create-group.js"></script>

<?php
    include("../include/footer.php");
?>