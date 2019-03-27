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
                
                var str = "<li class=\"list-group-item container-fluid m-1\" id=\""+element.GroupID+"_"+element.Admin_ID+"\">";
                str = str + "<div class=\"row\">"; 
                str = str + "<div class=\"col-md-2\"><h5>Group Name:</h5>";
                str = str + "<p>"+element.GroupName+"</p>";
                str = str + "</div>";
                str = str + "<div class=\"col-md-2\"><h5>Admin:</h5>";
                str = str + "<p>"+element.UserName+"</p>";
                str = str + "</div>";
                str = str + "<div class=\"col-md-4\"><h5>Description:</h5>";
                str = str + "<p>"+element.Description+"</p>";
                str = str + "</div>";
                str = str + "<div class=\"col-md-2 ml-auto\">";
                str = str + "<div class=\"float-right\">";
                str = str + "<button type=\"button\" class=\"btn m-1 btn-success btn-lg float-right join\" toggle=\"modal\" data-target=\"#"+element.GroupID+"\">Join Group</button></div>";
                str = str + "</div></div>";
                
                //modal
                str = str + "<div id=\""+element.GroupID+"\" class=\"modal fade\" role=\"dialog\"><div class=\"modal-dialog\">";
                //modal content
                str = str + "<div class=\"modal-content\"><div class=\"modal-header\"><h4 class=\"modal-title\">"+element.GroupName+"</h4><button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button></div>";
                str = str + "<div class=\"modal-body\"><p>Please enter the password: </p>";
                str = str + "<div class=\"input-group col\"><input type=\"password\" class=\"form-control modal-in\" placeholder=\"password\"><div class=\"input-group-btn input-group-append\"><button class=\"btn btn-outline-success modal-submit\" type=\"button\">Join</button></div></div></div>";
                str = str + "<div class=\"modal-footer\"><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button></div>";
                str= str + "</div></div></div>";
                str=str+"</li>";
                $("#group-list").append(str);
                $("#"+element.GroupID+"_"+element.Admin_ID).data("GroupID", element.GroupID);
            });
        })
        .fail(function() {
            alert( "Oops, an error occurred while searching. Try again later." );
        })
        .always(function() {
            //do nothing
        });
    });
    
    $('#group-list').on('click', 'button.join', function() {
        var GroupID = $(this).closest("li").data("GroupID");     
        $('#'+GroupID).modal('show');
    });
    
    $('#group-list').on('click', '.modal-submit', function() {
        var GroupID = $(this).closest("li").data("GroupID");     
        var pass = $(this).closest("li").find("input").val();
        var jqxhr = $.post("ajax/join-group.php", {GroupID: GroupID, Password: pass})
        .done(function(data) {
            window.location.href = "group-schedule-view.php?GroupID="+GroupID;
        })
        .fail(function(data) {
           //alert( "Error joining group. Try again later." );
        })
        .always(function() {
            //do nothing
        });
    });
    
    $('#group-list').on('keyup', '.modal-in', function(e) {
        if (e.which == 13) {
            $(".modal-submit").trigger('click');
        }
    });
    
    var term = getQueryVariable("search"); 
    if (term) {
        $('#input-search').val(term);
        $('#search').click();
    }
    
});

function getQueryVariable(variable) {
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}