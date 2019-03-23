$(document).ready(function(){

    var jqxhr = $.post("get-groups.php")
    .done(function(data) {
        var obj = JSON.parse(data);
        obj.forEach(function(element) {
            console.log(element);
            var str = "<li class=\"list-group-item container-fluid m-1\">";
            str = str + "<div class=\"row\">"; 
            str = str + "<div class=\"col-md-2\"><h5>Group Name:</h5>";
            str = str + "<p>"+element.GroupName+"</p>";
            str = str + "</div><div class=\"col-md-4\">";
            str = str + "<h5>Description:</h5>";
            str = str + "<p>"+element.Description+"</p></div>";
            str = str + "<div class=\"col-md-4 ml-auto\">";
            str = str + "<div class=\"float-right\"><a class=\"btn btn-primary m-1\" role=\"button\" style=\"Display: block;\" href=\"group-schedule-view.php?GroupID="+element.GroupID+"\">View Contents</a>";
            str = str + "<button class=\"btn m-1 btn-danger float-right\">Delete Group</button></div>";
            str = str + "</div></div></li>";
            $( "#group-list" ).append(str);
        });
    })
    .fail(function() {
        alert( "Oops, an error occurred while sending your data! Your account has not been updated." );
    })
    .always(function() {
        //do nothing
    });



    $('#change-email').bind("click",function(){
        
        if (!validateEmail($('#email').val()) || $('#email').val().length == 0) {
            alert("Please enter a valid email!");
            return;
        }
        
        var jqxhr = $.post("update-user.php", {Email: $('#email').val()})
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
        
        var jqxhr = $.post("update-user.php", {Affiliation: $('#affiliation').val()})
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