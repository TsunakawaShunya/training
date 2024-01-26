<x-app-layout>
  <x-slot name="title">とれログ ホーム</x-slot>
  <x-slot name="header">ホーム</x-slot>

  <div class="text-gray-800 font-bold font-mono text-center text-3xl p-4">
      <h1>こんにちは！{{ Auth::user()->name }} さん！</h1>
  </div>
  
  <div class="flex">
    <!-- 左側 -->
    <div class="w-1/2 p-4">
      <!-- カレンダー -->
      <div class="border border-4 border-gray-800 p-1 bg-gray-200 w-5/6 h-5/6 mx-auto" id='calendar'></div>
    </div>
  
    <!-- 右側　-->
    <div class="w-1/2 p-4">
      <!-- 体重 -->
      <div class="border border-4 border-gray-800 bg-gray-200 p-2">
        <form action="/home/weight" method="POST">
          @method('patch')
          @csrf
          <input type="hidden" name="menu[user_id]" value="{{ Auth::id() }}"/>
          <input type="text" name=weight[weight] placeholder="今日の体重 kg"/>
          <input type="submit" value="追加">
        </form>
        <canvas id="weight_chart" style="width: 80%; margin: auto"></canvas>
      </div>
    
      <!-- カロリー -->
      <div class="border border-4 border-gray-800 bg-gray-200 my-2 p-2">
        <form action="/home/calorie" method="POST">
          @method('patch')
          @csrf
          <input class="w-1/4" type="text" name=calorie[carbohydrate] placeholder="炭水化物 g"/>
          <input class="w-1/4" type="text" name=calorie[protain] placeholder="たんぱく質 g"/>
          <input class="w-1/4" type="text" name=calorie[fat] placeholder="脂質 g"/>
          <input type="submit" value="追加">
        </form>
        <canvas class="mx-auto" id="calorie_chart" style="width: 100%;"></canvas>
      </div>
    </div>
  </div>

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
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  <script>
    const ctx = document.getElementById('weight_chart');
    const chart = new Chart(ctx, {
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
  
  <!-- 食事 -->
  <script>
    const ctxCalorie = document.getElementById("calorie_chart").getContext('2d');
    const myChartCalorie = new Chart(ctxCalorie, {
      type: "bar",
      data: {
        labels:  @json($calorieLog->pluck('created_at')->map(function ($item) {
          return $item->format('Y-m-d'); // 'Y-m-d' フォーマットに変更
        })),
        datasets: [
          {
              label: "炭水化物 g",
              data: @json($calorieLog->pluck('carbohydrate')),
              backgroundColor: '#ffa500'
          },
          {
              label: "たんぱく質 g",
              data: @json($calorieLog->pluck('protain')),
              backgroundColor: "red"
          },
          {
              label: "脂質 g",
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
</x-app-layout>