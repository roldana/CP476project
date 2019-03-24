$(document).ready(function(){
    function loadMessages(view = 'g') {
        $.ajax({
            url:"ajax/get-messages.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data) {
                $('.list-group').html(data.output);
                if(data.unseenMessages > 0) {
                    $('.count').html(data.unseenMessages);
                } else {
                    $('.count').html("");
                }
            }   
        });
    }
    
    loadMessages();
    
    $('#messages').on('click', 'button', function() {
        var me = $(this);
        var jqxhr = $.post("ajax/remove-message.php", {MsgID: $(this).closest('li').attr('id')})
        .done(function(data) {  
            me.closest('li').remove();
        })
        .fail(function() {
            alert( "Oops, an error occurred while deleting your message! Your account has not been updated." );
        })
        .always(function() {
        //do nothing
        });
    });
    
});