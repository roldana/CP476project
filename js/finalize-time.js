$(document).ready(function(){
    var startTime = 28800;
    var endTime = 28800;
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
                    if (data.count == data.total) {
                        $('#' + cell).removeClass('bg-secondary');
                        $('#' + cell).removeClass('bg-success');
                        $('#' + cell).addClass('bg-dark');
                        $('#' + cell).addClass('text-white');
                    } else if (data.count > 0) {
                        $('#' + cell).removeClass('bg-dark');
                        $('#' + cell).removeClass('bg-success');
                        $('#' + cell).addClass('bg-secondary');
                        $('#' + cell).addClass('text-white');
                    } else {
                        $('#' + cell).removeClass('bg-dark');
                        $('#' + cell).removeClass('bg-secondary');
                        $('#' + cell).removeClass('bg-success');
                        $('#' + cell).removeClass('text-white');
                    }
                }  
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
    
     $('.clickable').mouseenter(function() {
        if (trigger) {
            checkCell(this.id);
        }
    });
    
    function checkCell(id) {
        cell = $('#'+id);
        if (cell.hasClass('bg-success')) {
            updateTimeSheet('','','',id);
        } else {
            cell.removeClass('bg-secondary');
            cell.removeClass('bg-dark');
            cell.addClass('bg-success');
            cell.addClass('text-white');
        }
    }
    
    $('table').on('mousedown', '.clickable', function(e) {  
        checkCell(this.id);
    });
    
    function validSheet () {
        var valid = true;
        var colFound = false;
        var colDone = false;
        var i, j;
        
        startTime = 28800;
        
        for (j = 0; j < 7; j++) {
            for (i = 0; i < 32; i++) {
                cell = $('#'+i+"-"+j);
                if (colDone && cell.hasClass('bg-success')) {
                    return false;
                }
                if (cell.hasClass('bg-success') && !colFound) {
                    colFound = true;
                    startTime = 28800 + (j * 86400) + (i * 1800);
                }
                if (colFound && !cell.hasClass('bg-success') && !colDone) {
                    colDone = true;
                    endTime = 28800 + (j * 86400) + (i * 1800);
                }
            }
            if (colFound && !colDone) {
                colDone = true;
                endTime = 28800 + (j * 86400) + (32 * 1800);
            }
        }
        
        return (colFound && colDone);
    }
    
    $('#submit-times').click(function () {
        if (!validSheet()) {
            alert('Verify only one meeting time has been selected.');   
        }
        else {
            var start = parseInt($('#group-start').val());
            
            var begin = (start + startTime);
            var end = (start + endTime);
            
            $.ajax({
                url:"ajax/finalize.php",
                method:"POST",
                data:{GroupID: $('#group-id').val(), start:begin, end:end},
                dataType:"text",
                success:function(data) {
                    window.location.replace("../php/group-schedule-view.php?GroupID="+$('#group-id').val());
                }
            });
        }
    });
    
});