$(document).ready(function() {
    var todayDate = moment().format('YYYY-MM-DD');
    var url = $('#m_calendar').attr('data-url');
    $('#m_calendar').fullCalendar({
        defaultDate: todayDate,
        selectable: true,
        select: function (start) {
            var getClickedDate = start.format('YYYY-MM-DD');
        },
        events: {
            url: url
        }
    });
});
