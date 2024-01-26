<x-app-layout>
    <x-slot name="title">トレーニング</x-slot>
    <x-slot name="header">トレーニング</x-slot>

    <div class="flex">
        <!-- 左側 -->
        <div class="w-1/4 p-4 bg-gray-400">
            @foreach($parts as $part)
                <div class='mb-2 text-lg font-bold'>
                    <a href="/training/menu/{{ $part->id }}">{{ $part->name }}</a>
                </div>
            @endforeach
        </div>

        <!-- 右側 -->
        <div class="w-3/4 p-4">
            <div class="my-4">
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">トレーニングトップページ</h1>
                <!-- カレンダー -->
                <div class="border border-4 border-gray-800 p-1 bg-gray-200 mx-auto" id='calendar'></div>
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
</x-app-layout>
