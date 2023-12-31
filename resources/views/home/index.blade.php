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
        
        
        <!-- 体重 -->
        <div class="add-weight-log">
          <form action="/home/index" method="POST">
            @method('patch')
            @csrf
            <input type="hidden" name="menu[user_id]" value="{{ Auth::id() }}"/>
            <input type="text" name=weight[weight] placeholder="今日の体重 kg"/>
            <input type="submit" value="追加">
          </form>
        </div>
        
        <!-- グラフ -->
        <canvas id="weight_chart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        
        <script>
          let ctx = document.getElementById('weight_chart');
          let chart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: @json($weightLog->pluck('created_at')->map(function ($item) {
                return $item->format('Y-m'); // 'Y-m-d' フォーマットに変更
              })),
              datasets: [{
                label: '体重推移(kg)',
                data: @json($weightLog->pluck('weight')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                xAxes: [{
                  type: 'category',
                  time: {
                    unit: 'month', // 一か月刻み
                    displayFormats: {
                      month: 'MMM YYYY'
                    },
                  },
                  ticks: {
                    autoSkip: true,
                    maxTicksLimit: 5,
                  }
                }]
              }
            }
          });
        </script>      
      </body>
    </html>
</x-app-layout>