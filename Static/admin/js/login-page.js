$(document).ready(function() {

    $("#login_form").submit(function(e) {
        $("body").removeClass("link_hover");
        $("body").addClass("waiting");
        e.preventDefault();
        var loginCredentials = Object();
        loginCredentials.user = $("#u_name").val();
        loginCredentials.password = $("#p_word").val();
        loginString = JSON.stringify(loginCredentials);

        $.post(
            "/admin/ajax/auth-user",
            loginString,
            function(data, status) {
                $("body").removeClass("waiting");
                var response = JSON.parse(data);
                if (response.result == 'SUCCESS_AUTHENTICATED') {
                    window.location.href = '/admin/dashboard';
                } else {
                    $("body").removeClass("waiting");
                    alert(response.result);
                }

            });
    });
});

// Send requests when login button pressed

// Redirect to a login page

// verify information on form before info actually sent
