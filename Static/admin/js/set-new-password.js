$(document).ready(function() {

    $("#submit_form").click(function(e) {
        var newPassword = $("#password1").val();
        if(newPassword == $("#password2").val()) {
            $("body").removeClass("link_hover");
            $("body").addClass("waiting");
            var newPasswordDetails = Object();
            newPasswordDetails.new_password = newPassword;
            newPasswordDetails.url_code = $('#url_code').val();
            var newPasswordDetailsString = JSON.stringify(newPasswordDetails);

            $.post(
                "/admin/ajax/set-new-password",
                newPasswordDetailsString,
                function(data, status) {
                    $("body").removeClass("waiting");
                    var response = JSON.parse(data);
                    if (response.result == 'SUCCESS') {
                        alert("You've set a new password. Try not to forget it this time.");
                        window.location.href = "/admin/dashboard";
                    } else {
                        "Something went wrong. No idea what.";
                    }

                });

        } else {
            $("#password_reset_feedback").text("Error: Passwords do not match");
        }
    });

    $("#password1").focus(function(e) {
        $("#password_reset_feedback").text("");
    });

    $("#password2").focus(function(e) {
        $("#password_reset_feedback").text("");
    });
});
