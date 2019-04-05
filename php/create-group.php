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
                    <h5 class="m-3">Select a Location for the Group:</h5>
                    <div id="map" style="width:100%;height:400px;"></div>
                    <script>
                    // Initialize and add the map
                    function initMap() {
                        // The location of wlu
                        var wlu = {lat: 43.473729, lng:-80.5289751};
                        var mapOptions = {disableDefaultUI: true, zoom: 16, center: wlu}
                        // The map, centered at wlu
                        var map = new google.maps.Map(
                            document.getElementById('map'), mapOptions);
                        
                        // The marker, positioned at wlu
                        var marker = new google.maps.Marker({position: wlu, map: map, draggable: true});
                        
                        google.maps.event.addListener(marker, 'dragend', function (evt) {
                            $('#lat').val(evt.latLng.lat().toFixed(8));
                            $('#lng').val(evt.latLng.lng().toFixed(8));
                        });
                        
                        $('#lat').val(marker.getPosition().lat().toFixed(8));
                        $('#lng').val(marker.getPosition().lng().toFixed(8));
                    }
                    </script>
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

                <input class="input-box d-none" type="text" id="lat" name="lat" id="lat">
                <input class="input-box d-none" type="text" id="lng" name="lng" id="lng">
                
                <button class="btn btn-outline-primary float-r" type="submit">Create Group</button>

            </form>

        </div>
    </div>
    
    <script src="../js/create-group.js"></script>
    
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB66pDOAGoYdLv3J8nk6oSD6OVjxPKsXb8&callback=initMap"></script>

<?php
    include("../include/footer.php");
?>