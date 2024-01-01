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
            <h1>こんにちは！{{ Auth::user()->name }} さん！</h1>
        </div>
        
        
        <div style="width: 40%;margin: auto">
        <div id='calendar'></div>

        <!-- トレーニングログ -->
        <!-- カレンダー -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let calendarId = document.getElementById('calendar');
                let calendar = new FullCalendar.Calendar(calendarId, {
                    initialView: 'dayGridMonth',
                    events: '/trainingLog',
                });
                calendar.render();
            });
        </script>
        
        
        <!-- カロリー -->
        <div class="add-calorie-log">
          <form action="/home/index" method="POST">
            @method('patch')
            @csrf
            <input type="text" name=calorie[carbohydrate] placeholder="炭水化物 kcal"/>
            <input type="text" name=calorie[protain] placeholder="たんぱく質 kcal"/>
            <input type="text" name=calorie[fat] placeholder="脂質 kcal"/>
            <input type="submit" value="追加">
          </form>
        </div>

        <!-- カロリーグラフ -->
        <canvas id="calorie_chart" width="400" height="300"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script>
          const ctx = document.getElementById("calorie_chart").getContext('2d');
          const myChart = new Chart(ctx, {
            type: "bar",
            data: {
              labels:  @json($calorieLog->pluck('created_at')->map(function ($item) {
                return $item->format('Y-m-d'); // 'Y-m-d' フォーマットに変更
              })),
              datasets: [
                {
                    label: "炭水化物 kcal",
                    data: @json($calorieLog->pluck('carbohydrate')),
                    backgroundColor: '#ffa500'
                },
                {
                    label: "たんぱく質 kcal",
                    data: @json($calorieLog->pluck('protain')),
                    backgroundColor: "red"
                },
                {
                    label: "脂質 kcal",
                    data: @json($calorieLog->pluck('fat')),
                    backgroundColor: "green"
                }
              ]
            },
            options: {
              responsive: false,
              title: {
                display: true,
                text: "カロリー記録"
              },
              legend: {
                position: 'top'
              },                
              scales: {
                xAxes: [
                    {
                        stacked: true  // 積み上げの指定
                    }
                ],
                yAxes: [
                    {
                        stacked: true  //  積み上げの指定
                    }
                ]
              }
            }
          });
        </script>      
      </body>
  </html>
</x-app-layout>