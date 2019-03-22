$().ready(function() {   
    $("#login-form").validate({
        
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            pass: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            username: {
                required: "Username is required",
                minlength: "Your username must be at least 3 characters long!"
            },
            pass: {
                required: "Password is required",
                minlength: "Your password must be at least 3 characters long!"
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