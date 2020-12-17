$(document).ready(function() {

    var value = $('#bl_demo').attr('data-demo');

    $('#demo_btn').on('click', function(e) {

        $.ajax({
            url: "../../../client/controller/binhluan.php",
            method: "post",
            data: { product: value },
            dataType: "text",
            success: function(data) {
                $('#bl_demo').html(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });


    $('#category').change(function() {
        var category = $(this).val();


    });
});