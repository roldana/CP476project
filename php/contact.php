<?php
    include("../include/header.php");
?>

    <div class="content-container">
        <div class="content-wrap">        
            
            <span class="form-title">
                Send Us An Email
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
                    <textarea class="input-area" type="text" name="body" placeholder="Message Body" rows="16"></textarea>
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