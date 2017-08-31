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
    console.log(selectedUrl);
});

$(document).on("change", "#add_new_background_image", function() {
    var file = this.files[0];
    uploadBackgroundImage(file);
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
            html += "<div class=\"background_list_option background_not_selected link_button\">" + id + "<div class=\"background_link do_not_display\">" + link + "</div></div>\n";
        }
        $("#background_list").html(html);
    });
}

function loadBackgroundImagePreview(url) {
    document.getElementById('background_preview').style.backgroundImage="url(" + url + ")";
};

function deleteBackground() {

}
