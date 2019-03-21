$().ready(function() {   
    
    $('#description').keyup(function(){
        $('.word-counter').text($.trim(this.value.length)+'/250');
    });
    
    jQuery.validator.addMethod("greaterThan", function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val()) || (Number(value) >= Number($(params).val())); 
    },'Must be greater than or equal to start date');
    
    $("#create-group-form").validate({
        rules: {
            groupname: {
                required: true,
                minlength: 3
            },
            description: {
                required: true,
                maxlength: 250
            },
            pass1: {
                required: true,
                minlength: 3
            },
            pass2: {
                required: true,
                minlength: 3,
                equalTo: "#pass1"
            },
            startdate: {
                required: true
            },
            enddate: {
                required: true,
                greaterThan: "#startdate"
            }
        },
        messages: {
            groupname: {
                required: "A group name is required",
                minlength: "Your group name must be at least 3 characters long!"
            },
            description: {
                required: "A description is required",
                maxlength: "Your description must be at most 250 characters long!"
            },
            pass1: {
                required: "Password is required",
                minlength: "Your password must be at least 3 characters long!"
            },
            pass2: {
                required: "Password is required",
                minlength: "Your password must be at least 3 characters long!",
                equalTo: "Passwords must match"
            },
            startdate: {
                required: "You must include a start date"
            },
            enddate: {
                required: "You must include an end date"
            }
        },
        errorPlacement: function(label, element) {
            label.addClass('arrow');
            label.addClass('input-box');
            label.insertAfter(element);
        },
        wrapper: 'span'
    });
});