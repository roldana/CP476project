var total = 0;
var timeslots = ['8:00AM', '8:30AM', '9:00AM', '9:30AM', '10:00AM', '10:30AM', '11:00AM', '11:30AM', '12:00PM', '12:30PM', '1:00PM', '1:30PM', '2:00PM', '2:30PM', '3:00PM', '3:30PM', '4:00PM', '4:30PM', '5:00PM', '5:30PM', '6:00PM', '6:30PM', '7:00PM', '7:30PM', '8:00PM', '8:30PM','9:00PM', '9:30PM', '10:00PM', '10:30PM', '11:00PM', '11:30PM'];

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

    function updateTimeSheet(get, update, remove, cell, users='') {
        $.ajax({
            url:"ajax/sheet.php",
            method:"POST",
            data:{GroupID: $('#group-id').val(), get:get, update:update, remove:remove, cell:cell, users:users},
            dataType:"json",
            success:function(data) {
                if (cell != '') {
                    $('#'+cell).html(data.count + ' of ' +  data.total);
                    if (data.total != total) {
                        total = data.total;
                        updateAllCells();    
                    }
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
                if (users != '') {
                    $('#users-selected').html(data.users);
                    if (data.count > 0) {
                        $('#selected').html('The following users ('+data.count+ ' of '+data.total+') have selected this time: ');
                    } else {
                        $('#selected').html('');
                    }
                }
            },
            error: function (data) { 
                console.log(data); 
            }
        });
    }
    
    updateTimeSheet('g','','','');
    
    function updateAllCells() {
        var i, j;
        for (i = 0; i < 32; i++) {
            for (j = 0; j < 7; j++) {
                updateTimeSheet('','','',i + "-" +j);
            }
        }
    }
    
    updateAllCells();
    
    function loadMessages(view = '') {
        var change = false;
        $.ajax({
            url:"ajax/chat.php",
            method:"POST",
            data:{view:view, GroupID: $('#group-id').val()},
            dataType:"json",
            success:function(data) {
                
                if (view != '') {
                    $('#chat-window').html(data.output);                 
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
    
    $('table').on('mouseup', '.clickable', function(e) {  
        var day = e.delegateTarget.tHead.rows[0].cells[this.cellIndex],
        time = this.parentNode.cells[0];
        $('#last-selected').html($(day).text()+", "+$(time).text());
        updateTimeSheet('','','',timeslots.indexOf($(time).text())+"-"+(this.cellIndex-1),'g');
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