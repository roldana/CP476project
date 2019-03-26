$(document).ready(function(){

    let trigger = false;
    document.addEventListener('mousedown', function(){
        trigger = true;
    });

    document.addEventListener('mouseup', function(){
        trigger = false;
    });

    $("#text-content").keyup(function (e) {
        if (e.which == 13) {
            $('#send-chat').trigger('click');
            $('#text-content').val('');
        }
    });

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
    });;
    
    $('.clickable').mouseenter(function() {
        if (trigger) {
            $(this).trigger('mousedown');
        }
    });
    
    $('.clickable').mousedown(function() {
        if ($(this).hasClass('bg-success')) {
            //remove this time from db
            $(this).removeClass('bg-success');
            $(this).removeClass('text-white');
        }
        else {
            //insert this time to db
            $(this).addClass('bg-success');
            $(this).addClass('text-white');
        }
    });
    
    // load new messages
    setInterval(function(){ 
        loadMessages('g');
    ;}, 1000);
});