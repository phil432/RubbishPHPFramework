$('#blog_options').hide();
$('#right_panel').show();

$(document).on("focus", "#title_text_edit", function() {
    $('#title_text_edit').addClass('focussed-text-input');
});

$(document).on("focusout", "#title_text_edit", function() {
    $('#title_text_edit').removeClass('focussed-text-input');
});

$(document).on("focus", "#blog_description_edit", function() {
    $('#blog_description_edit').addClass('focussed-text-input');
});

$(document).on("focusout", "#blog_description_edit", function() {
    $('#blog_description_edit').removeClass('focussed-text-input');
});

$(document).on("click", "#show_blog_options", function() {
    $("#blog_options").toggleClass('do_not_display');
    if($("#options_arrow").text() == 'keyboard_arrow_down') {
        $("#options_arrow").text('keyboard_arrow_up');
    } else {
        $("#options_arrow").text('keyboard_arrow_down')
    }
});

$(document).on("click", "#save_blog", function() {
    sendSaveBlog();
});

$(document).on("click", "#delete_blog", function() {
    deleteBlog();
});

// To allow for image upload
$(document).on("click", ".cke_button__image_icon", function () {
    $('#media_upload').click();
});

$(document).on("change", "#media_upload", function() {
    var file = this.files[0];
    uploadFile(file);
});

function uploadFile(file) {
    var url = '/admin/ajax/blog-media-upload';
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

function clearBlogId() {
    $('#blog_id_tag').text("0");
    $('#last_save_hash').text("");
}

// stuff to define how to display save status
function clearSavedStatus() {
    $("#save_status").removeClass("no_save_status_colour");
    $("#save_status").removeClass("pending_save_colour");
    $("#save_status").removeClass("not_saved_colour");
    $("#save_status").removeClass("saved_colour");
    $("#save_status").text("");
}

function updateSavedStatusToNoStatus() {
    clearSavedStatus();
    $('#save_status_tag').text("NOSAVESTATUS");
    $("#save_status").addClass("no_save_status_colour");
    $("#save_status").text("No save status");
}

function updateSaveStatusToSaved() {
    clearSavedStatus();
    $('#save_status_tag').text("SAVED");
    $("#save_status").addClass("saved_colour");
    $("#save_status").text("Saved");
}

function updateSaveStatusToPending() {
    clearSavedStatus();
    $('#save_status_tag').text("PENDING");
    $("#save_status").addClass("pending_save_colour");
    $("#save_status").text("Pending Save");
}

function updateSaveStatusToNotSaved() {
    clearSavedStatus();
    $('#save_status_tag').text("NOTSAVED");
    $("#save_status").addClass("not_saved_colour");
    $("#save_status").text("Unsaved");
}

function sendSaveBlog() {
    var saveString = blogToJSONString();
    $.post(
        '/admin/ajax/save-blog',
        saveString,
        function(data, status) {
            var result = JSON.parse(data);
            $('#blog_id_tag').text(result.blog_id);
            $('#last_save_hash').text(result.hash);
            updateSaveStatusToSaved();
        }
    );
}


function blogToJSONString() {
    var isNew = false;
    if ($("#blog_id_tag").text() == 0) {
        isNew = true;
    }

    var publishDate = $("#publishing_date").val();
    if (publishDate == "") {
        publishDate = null;
    }

    var slugString = $('#slug').val();
    slugString = slugString.replace(/\s+/g, '-').toLowerCase();

    var blogEntry = {
        blogId: $('#blog_id_tag').text(),
        isNew: isNew,
        publish: $("#publish").prop("checked"),
        publishingDate: publishDate,
        slug: slugString,
        title: $("#title_text_edit").val(),
        blogDescription: $("#blog_description_edit").val(),
        blogContents: CKEDITOR.instances['ckeditor1'].getData()
    }
    return JSON.stringify(blogEntry);
}

// save status stuff below
$.getScript("/static-admin-js/md5-generate.js", function(){
    // Not interested in doing anything here
});

function getBlogMd5() {
    var blogString = blogToJSONString();
    return result = md5(blogString);
}

function checkSaveStatus() {
    var lastSaveHash = $('#last_save_hash').text();
    var currentHash = getBlogMd5();
    var status = "NOSAVESTATUS";
    if(currentHash != "514ec9a499daf82f4e891f0a7f87f244") {
        status = "NOTSAVED";
    }
    if(lastSaveHash != 0 && lastSaveHash != currentHash) {
        status = "PENDING";
    } else if(lastSaveHash == currentHash) {
        status = "SAVED";
    }
    return status;
}

// actual operation to do this shit below
function saveUpdateIfNecessary() {
    var status = $('#save_status_tag').text();
    if(status != "SAVED" && status != "NOSAVESTATUS") {
        sendSaveBlog();
    }
}

// timed operations below
function updateSaveStatus() {
    var status = checkSaveStatus();
    if(status == "NOTSAVED") {
        updateSaveStatusToNotSaved();
    } else if(status == "PENDING") {
        updateSaveStatusToPending();
    } else if(status == "SAVED") {
        updateSaveStatusToSaved();
    } else if(status == "NOSAVESTATUS") {
        updateSavedStatusToNoStatus();
    }
}

// delete blog
function deleteBlog() {
    status = checkSaveStatus();
    if(status != "NOSAVESTATUS" && status != "NOTSAVED") {
        var confirmed = confirm("Are you sure you wish to delete this blog entry?");
        if(confirmed) {
            var blogDeleteString = JSON.stringify({blogId: $('#blog_id_tag').text()});
            $.post(
                '/admin/ajax/delete-blog',
                blogDeleteString,
                function(data, status) {
                    if(data == "DELETED") {
                        clearBlogId();
                        updateSaveStatusToNotSaved();
                        stopBlogEditProcesses();
                        alert("Blog entry has been deleted");
                        $('#editing_panel').load("components/blog-search-panel");
                    } else {
                        alert("Blog entry was not deleted");
                    }
                }
            )
        }
    } else {
        alert("Nothing is saved. Nothing to delete");
    }
}

// reset blog edit page
function resetBlogEdit() {
    $('#blog_id_tag').text("");
    $('#last_save_hash').text("");
    $('#save_status_tag').text("NOSAVESTATUS");
}

var updateSaveStatusInterval;
var saveUpdateIfNecessaryInterval;

function startBlogEditProcesses() {
    updateSaveStatusInterval = window.setInterval(updateSaveStatus, 1000);
    saveUpdateIfNecessaryInterval = window.setInterval(saveUpdateIfNecessary, 10000);
}

function stopBlogEditProcesses() {
    window.clearInterval(updateSaveStatusInterval);
    window.clearInterval(saveUpdateIfNecessaryInterval);
}
