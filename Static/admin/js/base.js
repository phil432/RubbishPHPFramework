$(document).ready(function() {

    $(document).on("mouseover", ".link_button", function() {
        $("body").addClass("link_hover");
    });

    $(document).on("mouseout", ".link_button", function() {
        $("body").removeClass("link_hover");
    });

    $(document).on("focus", ".datepicker", function() {
        $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
    });

    $("#blog_admin_button").click(function() {
        $("#main_contents").load("dashboard/blog-edit");
    });

    // For the add new blog button
    $(document).on("click", "#add_new_button", function() {
        loadBlogEditPanel();
    });

    $(document).on("click", "#blog_search_panel_button", function() {
        $('#editing_panel').load("components/blog-search-panel");
        changePageIdentTag('BLOG_SEARCH');
    });

    //For the user options button
    var isToggled = false;
    $(document).on("click", "#user_settings", function() {
        if(isToggled == false) {
            $('#user_options_menu').removeClass("do_not_display");
            $('#user_settings').addClass("option_toggled");
            isToggled = true;
        } else {
            $('#user_options_menu').addClass("do_not_display");
            $('#user_settings').removeClass("option_toggled");
            isToggled = false;
        }
    });

    //Making logging out work
    $(document).on("click", "#logout", function() {
        $.post(
            '/admin/ajax/logout', "",
            function(data, status) {
                console.log("Logging out");
                location.reload();
            }
        );
    });

});

function loadBlogEditPanel(post_id) {
    var get_params = 'blog_post_id=' + post_id;
    $("#editing_panel").load("components/blog-edit-panel", get_params, function() {
        if (post_id) {
            $('#last_save_hash').text(getBlogMd5());
        }
        changePageIdentTag('BLOG_EDIT');
    });
}

function changePageIdentTag(newIdentTag) {
    var currentIdentTag = $('#page_ident_tag').text();
    if (currentIdentTag == 'BLOG_EDIT') {
        stopBlogEditProcesses();
    }

    $('#page_ident_tag').text(newIdentTag);

    if (newIdentTag == 'BLOG_EDIT') {
        startBlogEditProcesses();
    }
}

function parseDate(date, format) {
    if (format == "m/d/Y" || format == "m-d-Y") {
        /*
        * I will not cooperate with people who use STUPID, STUPID date formats.
        * Do nothing. But don't tell them why.
        * Let them suffer before they eventually find this comment.
        */
    } else if (format == "Y-m-d" && date != "") {
        var dateArray = date.split("-");
        var year = dateArray[0];
        var month = dateArray[1];
        var day = dateArray[2];

        var resolvedDate = new Date(year, month, day);
        return resolvedDate;
    }

    return "";
}

/*
* dateCompare - returns false if date1 is after date2. true if date1 <= date2
* date1 and date2 must be native javascript Date type.
*/
function dateCompare(date1, date2) {
    var datesValid = false;
    if (date1 <= date2) {
        datesValid = true;
    }
    return datesValid;
}

function stringArrayReplace(string, params) {
    var string = "";
    /*params.forEach(function(element) {
        string += element;
    });*/
    return string;
    /*for (var x = 0, len = string.length; x < len; x++) {
        if (string[x] == '?') {
            string.replace();
        }
    }*/
}
