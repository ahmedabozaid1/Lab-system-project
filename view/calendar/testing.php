<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='/test/view/calendar/lib2/main.css' rel='stylesheet' />
    <script src='/test/view/calendar/lib2/main.js'></script>
    <script src="/test/view/calendar/lib2/jquery-3.5.1.js"></script>
    <script>

var eventsArray = <?php include_once "C:/xampp/htdocs/test/model/appointmentmodel.php";

$app = new appointment(1);
$json = $app->countAppointmentsInMonth();
echo $json; ?>;

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth'
      },
      events: eventsArray,
      eventRender: function(event, element, view) {
        // event.start is already a moment.js object
        // we can apply .format()
        var dateString = event.start.format("YYYY-MM-DD");
        $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#b72727');
      },
      dateClick: function(info) {
            alert('a day has been clicked!  ' + info.dateStr);
        },
      selectable:true,
      selectHelper:true,
      editable:true,
      eventLimit:true
    });

    calendar.render();
  });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>