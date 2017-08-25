$(document).on("click", "#add_new_background", function() {
    $('#add_new_background_image').click();
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
            console.log(response);
            $("#cke_75_textInput").val(response);
        }
    };
    fd.append("blog_id", $('#blog_id_tag').text());
    fd.append("upload_file", file);
    xhr.send(fd);
}
