$(document).ready(function() {
    var todayDate = moment().format('YYYY-MM-DD');
    var url = $('#m_calendar').attr('data-url');
    $('#m_calendar').fullCalendar({
        views: {
            month: {
                titleFormat: 'MM-YYYY',
            }
        }, 
        defaultDate: todayDate,
        selectable: true,
        displayEventTime: false,
        fixedWeekCount: false,
        select: function (start) {
            var getClickedDate = start.format('YYYY-MM-DD');
        },
        events: {
            url: url
        },
        loading: function(bool) {
            $('#loading').toggle(bool);
        }
    });
});
