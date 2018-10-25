$(document).ready(function () {
    $('#show').click(function () {
        $('.form-workspace').show();
        var array = [];
        $('.ui-selected').each(function () {
            array.push($(this).attr('id'));
        });
        $('#seats').val(array);
    });
    $('.all_seat').selectable({
        filter: '.seat',
        cancel: '.disabled',
        selected: function (event, ui) {
            $('.disabled').each(function () {
                if ($(this).hasClass('ui-selected')) {
                    $(this).removeClass('ui-selected');
                }
            });
        }
    });
});
