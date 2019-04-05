<?php
    include("../include/header.php");
?>
<script type="text/javascript" src="../js/group-list.js"></script>

<div class="content-container container-fluid">
    <div class="content-wrap">
        <span class="form-title">
            Groups
        </span>
        
        <div class="group-list inner-content-wrap">
            <div class="upper-content-wrap">
                
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary float-left" href="create-group.php" role="button">Create new group</a>
                    </div>
                    <div class="input-group col">
                        <input type="text" class="form-control" id="input-search" placeholder="search for a group">
                        <div class="input-group-btn input-group-append">
                            <button class="btn btn-outline-success" id="search" type="button">Search</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <ul class="list-group" id="group-list">
                <h4 class="mt-5">You have not searched for any group yet!</h4>
            </ul>
        </div>
    </div>
</div>
<?php
    include("../include/footer.php");
?>