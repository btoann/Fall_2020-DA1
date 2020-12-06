
$(document).ready(function () {

    /*  Update  */

    // Toggle Switches
    $('.sbs-toggle').on('click', function () {
        $(this).toggleClass('on');
        var active = $(this).parent().find('input[type = "hidden"]'),
            val = ($(this).hasClass('on')) ? 2 : 1;
        active.val(val);
    });
    $('input[type = "hidden"]').on('change', function () {
        console.log(true);
        var button = $(this).parent().find('.sbs-toggle'),
            val = $(this).val();
        if (val < 1)
            button.addClass('on');
        else
            button.removeClass('on');
    });

    var submit = $('#submit');
    $(submit).click(function (e) {
        swal({
            title: "Bạn có chắc chắn?",
            text: "Khi đã cập nhật thành công, bạn sẽ không thể nào khôi phục chúng",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {

            if (willDelete) {
                var id_parent = $('input[name = "id"]').val(),
                    name_parent = $('input[name = "name"]').val(),
                    active_parent = $('input[name = "active"]').val(),
                    id_childs = new Array(),
                    name_childs = new Array(),
                    parent_childs = new Array(),
                    active_childs = new Array();
                $('input[name = "ids[]"]').each(function () {
                    id_childs.push(this.value);
                });
                $('input[name = "names[]"]').each(function () {
                    name_childs.push(this.value);
                });
                $('select[name = "parents[]"]').each(function () {
                    parent_childs.push(this.value);
                });
                $('input[name = "actives[]"]').each(function () {
                    active_childs.push(this.value);
                });
                // Load ajax
                $.ajax({
                    url: "admin.php?ctrl=categories&act=update&id=" + id_parent,
                    method: "post",
                    data: {
                        update: 'update',
                        id: id_parent,
                        name: name_parent,
                        active: active_parent,
                        ids: id_childs,
                        names: name_childs,
                        parents: parent_childs,
                        actives: active_childs
                    },
                    success: function (data, actives) {
                        swal('Cập nhật thành công!', {
                            icon: 'success',
                        }).then(() => {
                            window.location.replace("admin.php?ctrl=categories&act=detail&id=" + id_parent);
                        });
                    },
                    error: function (jqXHR, status, error) {
                        swal('Có lỗi xảy ra!', 'Vui lòng thử lại', {
                            icon: '',
                        })
                        console.log('ajax\'s error:' + jqXHR.status);
                    }
                });
            }
            else {
                swal('Dữ liệu không thay đổi!');
            }

        });

    });


});