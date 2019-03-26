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
    
    $('table').bind('selectstart', function(event) {
        event.preventDefault();
    });

    function updateTimeSheet(get, update, remove, cell) {
        $.ajax({
            url:"ajax/sheet.php",
            method:"POST",
            data:{GroupID: $('#group-id').val(), get:get, update:update, remove:remove, cell:cell},
            dataType:"json",
            success:function(data) {
                if (cell != '') {
                    $('#'+cell).html(data.count + ' of ' +  data.total);
                }
                if (get != '') {
                    data.get.forEach(function(element) {
                        $('#' + element.Cell).addClass('bg-success');
                        $('#' + element.Cell).addClass('text-white');
                    });
                }
                if (update != '' && data.update) {
                    $('#' + cell).addClass('bg-success');
                    $('#' + cell).addClass('text-white');
                }
                if (remove != '' && data.remove) {
                    $('#' + cell).removeClass('bg-success');
                    $('#' + cell).removeClass('text-white');
                }
            },
            error: function (data) { 
                console.log(data); 
            }
        });
    }
    
    updateTimeSheet('g','','','');
    
    var i, j;
    for (i = 0; i < 32; i++) {
        for (j = 0; j < 7; j++) {
            updateTimeSheet('','','',i + "-" +j);
        }
    }
    
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
            updateTimeSheet('','','g',this.id);
        }
        else {
            //insert this time to db
            updateTimeSheet('','g','',this.id);
        }
    });
    
    // load new messages
    setInterval(function(){ 
        loadMessages('g');
    ;}, 1000);
});