<?php
class ShowAppViewCal {
    public function viewApp($event)
    {
        echo "<html>
        <meta charset='utf-8' />
            <link href='/test/view/calendar/lib2/main.css' rel='stylesheet' />
            <script src='/test/view/calendar/lib2/main.js'></script>
            <script src='/test/view/calendar/lib2/jquery-3.5.1.js'></script>
            <script>
        
        var eventsArray = $event;
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
                var dateString = event.start.format('YYYY-MM-DD');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#b72727');
              },
              dateClick: function(info) {
                      var found = false;
                      for(var i = 0; i < eventsArray.length; i++) {
                          if (eventsArray[i].start == info.dateStr) {
                              found = true;
                              break;
                          }
                      }
                      if(found){
                        var url = 'http://localhost/test/controller/showallindaycontoller.php';
                        url += '?date=' + info.dateStr;
                        window.location.href = url;
                      }else{
                          alert('There isn\'t any appointment in: ' + info.dateStr);
                      } 
                },
              selectable:true,
              selectHelper:true,
              editable:true,
              eventLimit:true
            });
        
            calendar.render();
          });
        
            </script>
        <head>   
        <link href='../../test/view/calendar/lib/calendar.css' type='text/css' rel='stylesheet' />
        </head>
        <body>
        <form action='/test/controller/waitingqueuecontroller.php' method='post'>
        <input type='date' class='form-control' name='date' required='required'>
        <input type='time' name='time'class='form-control'  required='required'>
        <button type='submit' name='search' class='btn btn-primary btn-bloc'>Search</button>
        </form>    
        <form action='/test/controller/createapoitmentcontroller.php' method='post'>;    
        <button type='submit' name='add' class='btn btn-success pull-right'> Add New Appointment </button>
        </form>
        <div id='calendar'></div>
        </body>
        </html>";
    }
}