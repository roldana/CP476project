$(document).ready(function(){

    function loadMessages(view = '') {
        var change = false;
        $.ajax({
            url:"ajax/chat.php",
            method:"POST",
            data:{view:view, GroupID: $('#group-id').val()},
            dataType:"json",
            success:function(data) {
                
                if (view != '') {
                    $('.list-group').html(data.output);                 
                }
                if(data.messageCount != $('#msg-count').val()) {
                    $('#msg-count').val(data.messageCount);
                    $('#scroll').animate({
scrollTop: $('#scroll').get(0).scrollHeight}, 2000);
                    change = true;
                }
            },
            error: function (data) { 
                console.log(data); 
            }
        });
        return change;
    }

    loadMessages('g');
    
    $( "#send-chat" ).click(function() {
        var GroupID = $("#group-id").val();
        var UserID = $("#user-id").val();
        var Content = $("#text-content").val();
        
        if (Content != "") {            
            var jqxhr = $.post("ajax/insert-chat.php", {GroupID: GroupID, UserID: UserID, Content: Content})
            .done(function(data) {  
                loadMessages('p');
            })
            .fail(function(data) {
                console.log(data);
            //do nothing
            })
            .always(function() {
            //do nothing
            });
        }
    });
    
    // load new messages
    setInterval(function(){ 
        loadMessages('g');
    ;}, 1000);
});