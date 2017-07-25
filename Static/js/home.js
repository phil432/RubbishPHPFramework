$(document).ready(function() {
    $(document).on("click", ".article_list_item", function() {
        var article_id = $(this).children('.article_id').text();
        window.location.href = "/article/" + article_id;
    });
})
