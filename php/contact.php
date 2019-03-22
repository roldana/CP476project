<?php
    include("../include/header.php");
    
    if (isset($_REQUEST) and isset($_REQUEST['body'])) {
          $fileLocation = getenv("DOCUMENT_ROOT") . "/CP476project/inquires/".time().".txt";
          $file = fopen($fileLocation,"w");
          $content = "{\"data\": {\"email\": \"".$_REQUEST['email']."\",";
          $content = $content."\n\"subject\": \"".$_REQUEST['subject']."\",";
          $content = $content."\n\"body\": \"".$_REQUEST['body']."\"}}";
          fwrite($file,$content);
          fclose($file);
    }
?>

    <div class="content-container">
        <div class="content-wrap">        
            
            <span class="form-title">
                Send Us A Message
            </span>
            <p> This is where you will be able to send us a message, and where we will be able to ignore them. </p>
            <form id="contact-form" method="POST" action="contact.php">
                <div class="wrap-input">
                    <input class="input-box" type="text" name="email" placeholder="Email">
                </div>
                <div class="wrap-input">
                    <input class="input-box" type="text" name="subject" placeholder="Subject">
                </div>
                <div class="wrap-input">
                    <textarea class="input-area" type="text" name="body" placeholder="Message Body" rows="10"></textarea>
                </div>
                    <button type="submit" class="btn btn-outline-success float-r">Send Message</button>
                </div>
            </form>
            
        </div>
    </div>

<script src="../js/contact.js"></script>
    
<?php
    include("../include/footer.php");
?>