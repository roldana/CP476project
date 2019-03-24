$(document).ready(function(){

    $("#input-search").keyup(function (e) {
        if (e.which == 13) {
            $('#search').trigger('click');
        }
    });

    $('#search').bind("click",function(){
      
        if ($('#input-search').val().length == 0) {
            alert("Please enter a value!");
            return;
        }
        
        var jqxhr = $.post("ajax/search-group.php", {Input: $('#input-search').val()})
        .done(function(data) {
            var obj = JSON.parse(data);
            
            $("#group-list" ).empty();
            
            var count = Object.keys(obj).length;
            
            if (count < 1) {
                $("#group-list" ).append("<h4 class=\"mt-5\">No results found!</h4>");
            }
            
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
                str = str + "<div class=\"col-md-4\"><h5>Admin:</h5>";
                str = str + "<p>"+element.UserName+"</p>";
                str = str + "</div>";
                str = str + "<div class=\"col-md-2 ml-auto\">";
                str = str + "<div class=\"float-right\"><button class=\"btn btn-primary m-1 float-right\">View Details</button>";
                str = str + "<button type=\"button\" class=\"btn m-1 btn-success float-right\">Join Group</button></div>";
                str = str + "</div></div></li>";
                $("#group-list" ).append(str);
            });
        })
        .fail(function() {
            alert( "Oops, an error occurred while sending your data! Your account has not been updated." );
        })
        .always(function() {
            //do nothing
        });
        
        
    });
    

});