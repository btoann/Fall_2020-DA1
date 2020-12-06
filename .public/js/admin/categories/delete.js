
$(document).ready(function () {

    /*  Delete  */

    var choices_table = $('#choices_table'),
        row = choices_table.find('tr');
    row.click(function (e) {
        var this_checkbox = $(this).find('input[name = "choices[]"]');
        if (e.target.nodeName == 'A')
            return;
        if (this_checkbox.is(':checked')) {
            this_checkbox.prop('checked', false);
        }
        else {
            this_checkbox.prop('checked', true);
        }
    });

    var submit = $('#submit');
    $(submit).click(function (e) {
        swal({
            title: "Bạn có chắc chắn?",
            text: "Khi đã xoá thành công, bạn sẽ không thể nào khôi phục chúng",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            var checkeds = $('input[type = checkbox]:checked');
            if (checkeds.length > 0) {
                if (willDelete) {
                    var checkboxs = new Array();
                    checkeds.each(function () {
                        checkboxs.push(this.value);
                    });
                    // Load ajax
                    $.ajax({
                        url: "admin.php?ctrl=categories&act=delete",
                        method: "post",
                        data: { delete: 'delete', choices: checkboxs },
                        success: function () {
                            console.log(checkboxs);
                            swal('Xoá thành công!', {
                                icon: 'success',
                            }).then(() => {
                                window.location.replace(window.location.href);
                            });
                        },
                        error: function (jqXHR, status, error) {
                            console.log('ajax\'s error:' + jqXHR.status);
                        }
                    });
                }
            }
            else {
                if (willDelete) {
                    swal('Không có danh mục nào được chọn!');
                }
            }

        });

    });


});