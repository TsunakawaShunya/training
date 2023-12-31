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
        
        <!-- 体重グラフ -->
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
        
        
        <!-- カロリー -->
        <div class="add-calorie-log">
          <form action="/home/index" method="POST">
            @method('patch')
            @csrf
            <input type="hidden" name="menu[user_id]" value="{{ Auth::id() }}"/>
            <input type="text" name=calorie[carbohydrate] placeholder="炭水化物 kcal"/>
            <input type="text" name=calorie[protain] placeholder="たんぱく質 kcal"/>
            <input type="text" name=calorie[fat] placeholder="脂質 kcal"/>
            <input type="submit" value="追加">
          </form>
        </div>

        <!-- カロリーグラフ -->
        <h1>カロリ－グラフ</h1>
        <canvas id="calorie_chart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script>
          function calorieChart() {
              var ctx = document.getElementById("calorie_chart").getContext('2d');
              var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                  labels:  ["00年", "05年", "10年", "15年", "20年"],
                  datasets: [
                    {
                        label: "系列Ａ",
                        data: [10, 20,  5, 15, 10],
                        backgroundColor: "red"
                    },
                    {
                        label: "系列Ｂ",
                        data: [ 5, 10, 10,  5,  8],
                        backgroundColor: "blue"
                    }
                  ]
                },
                options: {
                  responsive: false,
                  title: {
                    display: true,
                    fontSize: 20,
                    text: "積上げ棒グラフ"
                  },
                  legend: {
                    position: 'bottom'
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
            }
        </script>      
      </body>
  </html>
</x-app-layout>