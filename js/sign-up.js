$().ready(function() {   
    $("#sign-up-form").validate({
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
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
            agree: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Username is required",
                minlength: "Your username must be at least 3 characters long!"
            },
            email: "please enter a valid email address",
            pass1: {
                required: "Password is required",
                minlength: "Your password must be at least 3 characters long!"
            },
            pass2: {
                required: "Password is required",
                minlength: "Your password must be at least 3 characters long!",
                equalTo: "Passwords must match"
            },
            agree: {
                required: "You must agree to the terms"
            }
        },
        errorPlacement: function(label, element) {
            label.addClass('arrow');
            label.insertAfter(element);
        },
        wrapper: 'span'
    });
});