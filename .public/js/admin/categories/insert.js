
$(document).ready(function () {

    /*  Insert  */
    var checkbox = $('#check_insert').find('input[type = checkbox]');

    $('#parent_category').change(function () {
        if ($(this).val() == 0) {
            $('#hashtags_checkbox').addClass('hide');
            if (checkbox.is(':checked')) {
                checkbox.prop('checked', false);
                $('#hashtags_insert').addClass('hide');
            }
        }
        if ($(this).val() > 0) {
            $('#hashtags_checkbox').removeClass('hide');
            if (checkbox.not(':checked')) {
                checkbox.prop('checked', true);
                $('#hashtags_insert').removeClass('hide');
            }
        }
    });

    $('#check_insert').change(function () {
        $('#hashtags_insert').toggleClass('hide');
    });

    $('#add_hashtag').click(function () {
        $(this).before(
            '<div class="col-lg-3 mg-b-10"><input class="form-control" placeholder="#hashtag" type="text" name="hashtags[]"></div>'
        );
    });

    // var submit = $('#submit');
    // swal({
    //     title: "Good job!",
    //     text: "You clicked the button!",
    //     icon: "success",
    //     button: "Aww yiss!",
    // });

});