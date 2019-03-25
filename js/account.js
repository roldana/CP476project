$(document).ready(function(){

    var jqxhr = $.post("ajax/get-groups.php")
    .done(function(data) {
        var obj = JSON.parse(data);
        obj.forEach(function(element) {
            
            var dateObj = new Date(element.StartDate);
            var month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
            var date = ('0' + dateObj.getDate()).slice(-2);
            var year = dateObj.getFullYear();
            var StartDate = year + '/' + month + '/' + date;
            dateObj = new Date(element.EndDate);
            month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
            date = ('0' + dateObj.getDate()).slice(-2);
            year = dateObj.getFullYear();
            var EndDate = year + '/' + month + '/' + date;
            
            var str = "<li class=\"list-group-item container-fluid m-1\" id=\""+element.GroupID+"\">";
            str = str + "<div class=\"row\">"; 
            str = str + "<div class=\"col-md-2\"><h5>Group Name:</h5>";
            str = str + "<p>"+element.GroupName+"</p>";
            str = str + "</div>";
            str = str + "<div class=\"col-md-4\"><h5>Description:</h5>";
            str = str + "<p>"+element.Description+"</p>";
            str = str + "</div>";
            str = str + "<div class=\"col-md-2\">";
            str = str + "<h5>Start Date:</h5>";
            str = str + "<p>"+StartDate+"</p></div><div class=\"col-md-2\">";
            str = str + "<h5>End Date:</h5>";
            str = str + "<p>"+EndDate+"</p></div>";
            str = str + "<div class=\"col-md-2 ml-auto\">";
            str = str + "<div class=\"float-right\"><a class=\"btn btn-primary m-1\" role=\"button\" style=\"Display: block;\" href=\"group-schedule-view.php?GroupID="+element.GroupID+"\">View Contents</a>";
            str = str + "<button type=\"button\" class=\"btn m-1 btn-danger float-right del\">Delete Group</button></div>";
            str = str + "</div></div></li>";
            $("#group-list" ).append(str);
        });
    })
    .fail(function() {
        alert( "Oops, an error occurred while grabbing your current groups! Please come back at a later time to view them." );
    })
    .always(function() {
        //do nothing
    });

    var jqxhr = $.post("ajax/get-groups2.php")
    .done(function(data) {
        var obj = JSON.parse(data);
        obj.forEach(function(element) {
            
            var dateObj = new Date(element.StartDate);
            var month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
            var date = ('0' + dateObj.getDate()).slice(-2);
            var year = dateObj.getFullYear();
            var StartDate = year + '/' + month + '/' + date;
            dateObj = new Date(element.EndDate);
            month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
            date = ('0' + dateObj.getDate()).slice(-2);
            year = dateObj.getFullYear();
            var EndDate = year + '/' + month + '/' + date;
            
            var str = "<li class=\"list-group-item container-fluid m-1\" id=\""+element.GroupID+"\">";
            str = str + "<div class=\"row\">"; 
            str = str + "<div class=\"col-md-2\"><h5>Group Name:</h5>";
            str = str + "<p>"+element.GroupName+"</p>";
            str = str + "</div>";
            str = str + "<div class=\"col-md-4\"><h5>Description:</h5>";
            str = str + "<p>"+element.Description+"</p>";
            str = str + "</div>";
            str = str + "<div class=\"col-md-2\">";
            str = str + "<h5>Start Date:</h5>";
            str = str + "<p>"+StartDate+"</p></div><div class=\"col-md-2\">";
            str = str + "<h5>End Date:</h5>";
            str = str + "<p>"+EndDate+"</p></div>";
            str = str + "<div class=\"col-md-2 ml-auto\">";
            str = str + "<div class=\"float-right\"><a class=\"btn btn-primary m-1\" role=\"button\" style=\"Display: block;\" href=\"group-schedule-view.php?GroupID="+element.GroupID+"\">View Contents</a>";
            str = str + "<button type=\"button\" class=\"btn m-1 btn-danger float-right leave\">Exit Group</button></div>";
            str = str + "</div></div></li>";
            $("#group-list" ).append(str);
        });
    })
    .fail(function() {
        alert( "Oops, an error occurred while grabbing your current groups! Please come back at a later time to view them." );
    })
    .always(function() {
        //do nothing
    });
    
    $('#group-list').on('click', 'button.del', function() {
        var me = $(this);
        var jqxhr = $.post("ajax/remove-group.php", {GroupID: $(this).closest('li').attr('id')})
        .done(function(data) {
            me.closest('li').remove();
        })
        .fail(function() {
            alert( "Oops, an error occurred while sending your data! Your account has not been updated." );
        })
        .always(function() {
        //do nothing
        });
    });
    
    $('#group-list').on('click', 'button.leave', function() {
        var me = $(this);
        var jqxhr = $.post("ajax/leave-group.php", {GroupID: $(this).closest('li').attr('id')})
        .done(function() {
            me.closest('li').remove();
        })
        .fail(function() {
            alert( "Oops, an error occurred while sending your data! Your account has not been updated." );
        })
        .always(function() {
        //do nothing
        });
    });

    $('#change-email').bind("click",function(){
        
        if (!validateEmail($('#email').val()) || $('#email').val().length == 0) {
            alert("Please enter a valid email!");
            return;
        }
        
        var jqxhr = $.post("ajax/update-user.php", {Email: $('#email').val()})
        .done(function(data) {
            $('#p-email').text(data);
            $('#email').val("");            
        })
        .fail(function() {
            alert( "Oops, an error occurred while sending your data! Your account has not been updated." );
        })
        .always(function() {
            //do nothing
        });   
    });

    $('#change-affiliation').bind("click",function(){
        
        if ($('#affiliation').val().length == 0) {
            alert("Please enter a value!");
            return;
        }
        
        var jqxhr = $.post("ajax/update-user.php", {Affiliation: $('#affiliation').val()})
        .done(function(data) {
            $('#p-affiliation').text(data);
            $('#affiliation').val("");              
        })
        .fail(function() {
            alert( "Oops, an error occurred while sending your data! Your account has not been updated." );
        })
        .always(function() {
            //do nothing
        });
    });
    
    
});

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}