$(document).ready(function() {
    $('#category').change(function() {
        var category = $(this).val();

        $.ajax({
            url: "seller/controller/categories.php",
            method: "post",
            data: { category_hastag: category },
            dataType: "text",
            success: function(data) {
                $('#category_hashtag').html(data);
            }
        });
    });
});