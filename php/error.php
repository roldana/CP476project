<?php 
include "../include/header.php"
?>
        
<div class="content-container">      
    <div class="content-wrap">
        <h4>Oops, an error has occured!</h4>
        <?php
             if (isset($_REQUEST['error'])) {
                 echo "<p>".$_REQUEST['error']."</p>";
             }   
         ?>
    </div>    
</div>

<?php 
include "../include/footer.php"
?>        
