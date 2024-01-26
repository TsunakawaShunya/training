<x-app-layout>
    <x-slot name="title">トレーニング</x-slot>
    <x-slot name="header">トレーニング</x-slot>

    <div class="flex">
        <!-- 左側 -->
        <div class="w-1/4 p-4 bg-gray-400">
            <div class="flex justify-end">
                <button id="add-part-button" class="border-4 border-solid border-gray-500 bg-white p-1 mr-2 my-1 font-bold font-mono text-center text-lg">
                    フォルダ追加
                </button>
            </div>

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
  
  <script>
        // フォルダ追加ボタンがクリックされたときの処理
        document.getElementById('add-part-button').addEventListener('click', function() {
            const partName = prompt("フォルダ名を入力してください:");
            const userId = {!! json_encode(Auth::id()) !!};
            console.log(partName, userId);
            
            // FormDataオブジェクトを作成してデータを追加
            const formData = new FormData();
            formData.append('part[name]', partName);
            formData.append('part[user_id]', userId);

            // XMLHttpRequestを作成してPOSTリクエストを送信
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/training/part/add');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // LaravelのCSRFトークンをヘッダーに追加
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        window.location.reload();       // 再読み込み
                    } else {
                        console.error('Error:', xhr.statusText);
                    }
                }
            };
            xhr.send(formData);
        });
  </script>
</x-app-layout>
