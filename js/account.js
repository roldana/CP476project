$(document).ready(function(){

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
            alert( "Oops, an error occured while sending your data! Your account has not been updated." );
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
            alert( "Oops, an error occured while sending your data! Your account has not been updated." );
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