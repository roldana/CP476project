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
            loadMessages();
        })
        .fail(function() {
            alert( "Oops, an error occurred while deleting your message! Your account has not been updated." );
        })
        .always(function() {
        //do nothing
        });
    });
    
    
    $( "#submit-message" ).click(function() {

        var subject = $("#subject").val();
        var body = $("#body").val();
    
        if (subject != "" && body != "") {
            $("#bad-subject").addClass('d-none');
            $("#bad-body").addClass('d-none');
            var jqxhr = $.post("ajax/check-user-exists.php", {UserName: $("#to").val()})
            .done(function(data) {  
                sendMessage();
            })
            .fail(function(data) {
                $("#bad-user").removeClass('d-none');
            })
            .always(function() {
            //do nothing
            });
        } else {
            $("#bad-subject").addClass('d-none');
            $("#bad-body").addClass('d-none');
            if (subject == "") {
                $("#bad-subject").removeClass('d-none');
            }
            if (body == "") {
                $("#bad-body").removeClass('d-none');
            }
        }
    });
    
    $(window).on('show.bs.modal', function() { 
        $("#bad-user").addClass('d-none');
        $("#bad-subject").addClass('d-none');
        $("#bad-body").addClass('d-none');
    });
    
    function sendMessage() {
        var From = "";
        var jqxhr = $.post("ajax/send-message.php", {To: $("#to").val(), From: From, Subject: $("#subject").val(), Body: $("#body").val()})
        .done(function(data) {  
            loadMessages();
            $('#modal').modal('toggle');
        })
        .fail(function(data) {
            alert("Error sending message, try again later");
        })
        .always(function() {
        //do nothing
        });
    }
});