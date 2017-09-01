$(document).on("click", "#add_new_background", function() {
    $('#add_new_background_image').click();
});

$(document).on("click", ".background_list_option", function() {
    $(".background_list_option").removeClass("background_selected");
    $(".background_list_option").addClass("background_not_selected");
    $(this).removeClass("background_not_selected");
    $(this).addClass("background_selected");

    var selectedUrl = $(this).children(".background_link").text();
    loadBackgroundImagePreview(selectedUrl);
});

$(document).on("click", "#delete_current_selected", function() {
    deleteBackground();
});

$(document).on("change", "#add_new_background_image", function() {
    var file = this.files[0];
    uploadBackgroundImage(file);
});

$(document).on("click", "#set_as_displayed", function(){
    setBackgroundImageAsSelected();
});

function uploadBackgroundImage(file) {
    var url = '/admin/ajax/background-image-upload';
    var xhr = new XMLHttpRequest();
    var fd = new FormData();
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Every thing ok, file uploaded
            var response = xhr.responseText;
        }
    };
    fd.append("blog_id", $('#blog_id_tag').text());
    fd.append("upload_file", file);
    xhr.send(fd);
    fetchAllBackgrounds();
}

function fetchAllBackgrounds() {
    var html = "";
    $.get( '/admin/ajax/fetch-all-backgrounds', function( data ) {
        var backgrounds = JSON.parse(data);
        for (x = 0; x < backgrounds.length; x++) {
            var id = backgrounds[x].id;
            var link = backgrounds[x].url;
            html += "<div class=\"background_list_option background_not_selected link_button\">\
                        <div class=\"background_id\">" + id + "</div>\
                        <div class=\"is_current\"></div>\
                        <div class=\"background_link do_not_display\">" + link + "\
                    </div></div>\n";
        }
        $("#background_list").html(html);
    });
    loadCurrentBackground();
}

function loadBackgroundImagePreview(url) {
    document.getElementById('background_preview').style.backgroundImage="url(" + url + ")";
};

function loadCurrentBackground() {
    $(".is_current").text("");
    $.get( '/admin/ajax/get-current-background-id', function( data ) {
        var result = JSON.parse(data);
        var currentBackground = result.id;

        var backgrounds = $(".background_list_option");
        for (x = 0; x < backgrounds.length; x++) {
            var backgroundOption = backgrounds.eq(x);
            if (backgroundOption.children(".background_id").text() == currentBackground) {
                backgroundOption.children(".is_current").text("(Current)");

                $(".background_list_option").removeClass("background_selected");
                $(".background_list_option").addClass("background_not_selected");
                $(backgroundOption).removeClass("background_not_selected");
                $(backgroundOption).addClass("background_selected");

                var url = backgroundOption.children(".background_link").text();
                loadBackgroundImagePreview(url);
            }
        }
    });
}

function deleteBackground() {
    // find the id of the currently displayed image
    var id = $(".background_selected .background_id").text();
    var deleteArray = {
        "id": id
    }
    var deleteString = JSON.stringify(deleteArray);

    $.post(
        '/admin/ajax/delete-background',
        deleteString,
        function(data, status) {
            var result = JSON.parse(data);
            if (result.status == "SUCCESS") {
                fetchAllBackgrounds();
                alert("Deleted");
            } else {
                alert("Something went wrong. Hmmmm");
            }
        }
    );
}

function setBackgroundImageAsSelected() {
    var selectedBackground = $(".background_selected");
    var backgroundIdDiv = selectedBackground.children(".background_id");
    backgroundIdDiv = backgroundIdDiv.eq(0);
    var id = backgroundIdDiv.text();
    var setArray = {
        "id": id
    }
    var setString = JSON.stringify(setArray);

    $.post(
        '/admin/ajax/set-current-background',
        setString,
        function(data, status) {
            loadCurrentBackground();
        }
    );
}
