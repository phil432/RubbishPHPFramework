function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function clearErrors() {
    $("#error_dialog").addClass("hidden");
    $("#error_dialog").text("");
}

document.getElementById("send_message").addEventListener("click", function() {
    clearErrors();
    $("body").addClass("waiting");
    var emailProvided = document.getElementById("email_input").value;
    if (isEmail(emailProvided) == false) {
        $("#error_dialog").text("Message not sent: Email not valid.");
        $("#error_dialog").removeClass("hidden");
    } else {
        var message = Object();
        message.emailAddress = $("#email_input").val();
        message.messageBody = $("#message_body").val().replace(/\n/g, '<br>');
        var messageJson = JSON.stringify(message);

        $.post(
            "/ajax/contact-form",
            messageJson,
            function(data, status) {
                $("body").removeClass("waiting");
                var response = JSON.parse(data);
                if (response.result == 'SUCCESS') {
                    $("#email_form").html("Message sent. Thanks! I'll get back to you soon.");
                } else {
                    alert("Hmmmm. Something went wront. Not sure what. Maybe give it another go.");
                }
            }
        );
    }
})

$(document).ready(function() {
    $("#message_body").focus(function () {
        $("#message_body").text("");
    })

    $("#message_body").focusout(function () {
        if ($("#message_body").text() == "") {
            $("#message_body").text("Your message...");
        }
    })

    $("#email_input").focus(function() {
        clearErrors();
    })
})
