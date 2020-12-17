
$("#begin").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss"
});
$("#end").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss"
});

$(document).ready(function () {

    var radio = $('.rdiobox').find('input[type = radio]');
    radio.change(function () {
        if ($(this).is(':checked')) {
            if ($(this).attr('id') == 'type1') {
                $('#discount').attr('max', 100);
                $('#discount_extension').html('%');
            }

            if ($(this).attr('id') == 'type2') {
                $('#discount').removeAttr('max');
                $('#discount_extension').html('VNĐ');
            }
        }
    });
});


$(function () {
    'use strict'

    // Toggle Switches
    $('.sbs-toggle').on('click', function () {
        $(this).toggleClass('on');
        var active = $(this).parent().find('input[type = "hidden"]'),
            val = ($(this).hasClass('on')) ? 2 : 1;
        active.val(val);
    });

    // Input Masks
    $('#dateMask').mask('99/99/9999');
    $('#phoneMask').mask('(999) 999-9999');
    $('#phoneExtMask').mask('(999) 999-9999? ext 99999');
    $('#ssnMask').mask('999-99-9999');

    // Color picker
    $('#colorpicker').spectrum({
        color: '#17A2B8'
    });

    $('#showAlpha').spectrum({
        color: 'rgba(23,162,184,0.5)',
        showAlpha: true
    });

    $('#showPaletteOnly').spectrum({
        showPaletteOnly: true,
        showPalette: true,
        color: '#DC3545',
        palette: [
            ['#1D2939', '#fff', '#0866C6', '#23BF08', '#F49917'],
            ['#DC3545', '#17A2B8', '#6610F2', '#fa1e81', '#72e7a6']
        ]
    });

    // Datepicker
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true
    });

    $('#datepickerNoOfMonths').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 2
    });

    // AmsbseUI Datetimepicker
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        autoclose: true
    });

    // jQuery Simple DateTimePicker
    $('#datetimepicker2').appendDtpicker({
        closeOnSelected: true,
        onInit: function (handler) {
            var picker = handler.getPicker();
            $(picker).addClass('sbs-datetimepicker');
        }
    });

    new Picker(document.querySelector('#datetimepicker3'), {
        headers: true,
        format: 'MMMM DD, YYYY HH:mm',
        text: {
            title: 'Pick a Date and Time',
            year: 'Year',
            month: 'Month',
            day: 'Day',
            hour: 'Hour',
            minute: 'Minute'
        },
    });


    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search'
        });

        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one'
        });
    });

    $('.rangeslider1').ionRangeSlider();

    $('.rangeslider2').ionRangeSlider({
        min: 100,
        max: 1000,
        from: 550
    });

    $('.rangeslider3').ionRangeSlider({
        type: 'double',
        grid: true,
        min: 0,
        max: 1000,
        from: 200,
        to: 800,
        prefix: '$'
    });

    $('.rangeslider4').ionRangeSlider({
        type: 'double',
        grid: true,
        min: -1000,
        max: 1000,
        from: -500,
        to: 500,
        step: 250
    });

});