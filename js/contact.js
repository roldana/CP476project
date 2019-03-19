$().ready(function() {   
    $("#contact-form").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            subject: {
                required: true,
            },
            body: {
                required: true
            }
        },
        messages: {
            subject: "Subject line is required",
            email: "Please enter a valid email address",
            body: "Message body is required"
        },
        errorPlacement: function(label, element) {
            label.addClass('arrow');
            label.insertAfter(element);
        },
        wrapper: 'span'
    });
});