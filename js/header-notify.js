$(document).ready(function(){
// updating the view with notifications using ajax
    function load_unseen_notification(view = '') {
        $.ajax({
            url:"ajax/get-messages.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data) {
                if(data.unseenMessages > 0) {
                    $('.count').html(data.unseenMessages);
                }
            }   
        });
    }
    
    load_unseen_notification();

    // load new messages
    setInterval(function(){ 
        load_unseen_notification();;
    }, 5000);
});