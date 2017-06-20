$(document).ready(function() {
    var optionsShown = false;
    $(document).on("click", "#more_options", function() {
        $("#options_table_container").toggleClass("do_not_display");
        if (optionsShown == false) {
            $("#more_options").text("Hide Options");
            optionsShown = true;
        } else {
            $("#more_options").text("Show Options");
            optionsShown = false;
        }
    });

    $(document).on("click", "#search_button", function() {
        clearErrors();
        var searchQuery = composeSearchQuery();
        var validationErrors = validateSearchQuery(searchQuery);
        if (validationErrors.length > 0) {
            processErrors(validationErrors);
        } else {
            // this means that there are no validation errors caught at this stage
            var searchQueryString = JSON.stringify(searchQuery);
            var results = fetchSearchResults(searchQueryString);
        }
    });

    $(document).on("focus", "#published_from", function() {
        removePublishedDateError();
    });

    $(document).on("focus", "#published_to", function() {
        removePublishedDateError();
    });

    $(document).on("focus", "#created_from", function() {
        removeCreatedDateError();
    });

    $(document).on("focus", "#created_to", function() {
        removeCreatedDateError();
    });

    $(document).on("click", ".view_short_desription_icon", function() {
        var sd_div_id = '#short_description_' + $(this).parent().children('.post_id').text();
        $(sd_div_id).toggleClass('do_not_display');
    });

    $(document).on("click", ".search_load_click", function() {
        var post_id = $(this).parent().children('.post_id').text();
        loadBlogEditPanel(post_id);
    });
});

function composeSearchQuery() {
    var searchQuery = {
        queryString: $("#search_query_input").val(),
        published: $("#published").is(':checked'),
        deepSearch: $("#deep_search").is(':checked'),
        publishedFrom: $("#published_from").val(),
        publishedTo: $("#published_to").val(),
        createdFrom: $("#created_from").val(),
        createdTo: $("#created_to").val()
    };

    return searchQuery;
}

function fetchSearchResults(searchQueryString) {
    var responseString;
    $("#search_results_list").html("");
    $.post(
        '/admin/ajax/search-blogs',
        searchQueryString,
        function(data, status) {
            console.log(data);
            var results = JSON.parse(data);
            var finalSearchHTML = "";

            results.forEach(function(result) {
                finalSearchHTML += createResultHTMLFromResult(result);
            });
            if (finalSearchHTML == "") {
                finalSearchHTML = '<p class="nice_font" style="padding:5px;">No posts found</p>';
            }
            $("#search_results_table").removeClass("do_not_display");
            $("#search_results_list").html(finalSearchHTML);
        }
    )
    return responseString;
}

function createResultHTMLFromResult(result) {
    var publishedIcon = 'close';
    if (result.published == 1) {
        publishedIcon = 'done';
    }
    var short_description_text = result.short_description
    if (short_description_text == "") {
        short_description_text = "No short description";
    }
    var searchResultHtml = '<div class="search_result nice_font search_result_font_size">'
            + '<div class="post_id do_not_display">' + result.id + '</div>'
            + '<i name="hello" class="view_short_desription_icon material-icons nice_button_colours link_button">add</i>'
            + '<div class="search_load_click nice_button_colours link_button"><div class="result_title_width display_inline">' + result.title.substring(0, 85) + '</div>'
            + '<div class="result_created_width">' + result.created + '</div>'
            + '<div class="result_posted_width"><i class="material-icons">' + publishedIcon + '</i></div></div>'
            + '<div id="short_description_' + result.id + '" class="short_description_preview nice_font do_not_display">' + short_description_text + '</div>'
            + '</div>';
    return searchResultHtml;
}

function validateSearchQuery(searchQuery) {
    // errors is an associative array. should be all like errorType: error message or whatever
    var errors = new Array();

    var validPublished = dateCompare(parseDateFromInput(searchQuery.publishedFrom), parseDateFromInput(searchQuery.publishedTo));
    var validCreated = dateCompare(parseDateFromInput(searchQuery.createdFrom), parseDateFromInput(searchQuery.createdTo));

    if (validPublished == false) {
        errors.push('PUBLISHED_DATE_ERROR');
    }
    if (validCreated == false) {
        errors.push('CREATED_DATE_ERROR');
    }

    return errors;
}

function processErrors(errors) {
    var messages = new Array();
    errors.forEach(function(errorType) {
        if (errorType == 'PUBLISHED_DATE_ERROR') {
            messages.push(addPublishedDateError());
        } else if (errorType == 'CREATED_DATE_ERROR') {
            messages.push(addCreatedDateError());
        }
    })

    if (messages.length > 0) {
        var errorText = "";
        messages.forEach(function(message) {
            errorText = errorText + message + '<br>';
        })
        $('#search_query_errors_box').html(errorText);
        $('#search_query_errors_box').removeClass('do_not_display');
    }
}

function clearErrors() {
    removePublishedDateError();
    removeCreatedDateError();
    $('#search_query_errors_box').text("");
    $('#search_query_errors_box').addClass('do_not_display');
}

function addPublishedDateError() {
    $('#published_from').removeClass('no_error_border');
    $('#published_from').addClass('error_border');
    $('#published_to').removeClass('no_error_border');
    $('#published_to').addClass('error_border');
    return "- Published from date must be before published to date";
}

function addCreatedDateError() {
    $('#created_from').removeClass('no_error_border');
    $('#created_from').addClass('error_border');
    $('#created_to').removeClass('no_error_border');
    $('#created_to').addClass('error_border');
    return "- Created from date must be before created to date";
}

function removePublishedDateError() {
    $('#published_from').removeClass('error_border');
    $('#published_from').addClass('no_error_border');
    $('#published_to').removeClass('error_border');
    $('#published_to').addClass('no_error_border');
}

function removeCreatedDateError() {
    $('#created_from').removeClass('error_border');
    $('#created_from').addClass('no_error_border');
    $('#created_to').removeClass('error_border');
    $('#created_to').addClass('no_error_border');
}

function parseDateFromInput(date) {
    return parseDate(date, "Y-m-d");
}
