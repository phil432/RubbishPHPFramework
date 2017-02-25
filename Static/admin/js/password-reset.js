$(document).ready(function() {

    $("#password_reset_form").submit(function(e) {
        $("body").removeClass("link_hover");
        $("body").addClass("waiting");
        e.preventDefault();
        var resetDetails = Object();
        resetDetails.reset_email = $("#u_name").val();
        resetString = JSON.stringify(resetDetails);

        $.post(
            "/admin/ajax/password-reset-request",
            resetString,
            function(data, status) {
                $("body").removeClass("waiting");
                var response = JSON.parse(data);
                if (response.result == 'SUCCESS') {
                    alert("You should have received an email containing a link that you can use to reset your password. Log in to your mail and do the needful.");
                } else {
                    alert("Something has gone wrong. No idea what it could be. Ah well.");
                }

            })
    });
});

// Send requests when reset button pressed
