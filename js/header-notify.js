$(document).ready(function(){
// updating the view with notifications using ajax
    function loadMessages(view = '') {
        $.ajax({
            url:"ajax/get-messages.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data) {
                if(data.unseenMessages > 0) {
                    $('.count').html(data.unseenMessages);
                } else {
                    $('.count').html("");
                }
            }   
        });
    }
    
    loadMessages();

    // load new messages
    setInterval(function(){ 
        loadMessages();;
    }, 5000);
});