<x-app-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <title>Training</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        </head>
        <body>
            <div class='greeting'>
                <h1>こんにちは！{{ $user->name }} さん！</h1>
            </div>
            
            
            <div style="width: 50%;margin: auto">
            <div id='calendar'></div>

            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    let calendarId = document.getElementById('calendar');
                    let calendar = new FullCalendar.Calendar(calendarId, {
                        initialView: 'dayGridMonth',
                        events: '/response',
                    });
                    calendar.render();
                });
            </script>
        </body>
    </html>
</x-app-layout>