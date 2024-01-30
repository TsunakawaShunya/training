<x-app-layout>
    <x-slot name="title">トレーニング中</x-slot>
    <x-slot name="header">トレーニング</x-slot>

    <div class="flex h-screen">
        <!-- 左側 -->
        <div class="w-1/4 p-4 bg-gray-400">
            <div class="flex justify-end">
                <button id="add-part-button" class="p-1 mr-2 my-1 font-bold font-mono text-center text-lg">
                    <svg class="h-8 w-8 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                </button>
            </div>

            @foreach($parts as $part)
                <div class='mb-2 text-lg font-bold'>
                    <a href="/training/menu/{{ $part->id }}">{{ $part->name }}</a>
                    <form action="/training/part/delete" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $part->id }}">
                        <input class="border-4 border-solid border-red-500 bg-red-100 p-1 mr-2 my-1 font-bold font-mono text-center ml-5" type="submit" value="削除">
                    </form>
                </div>
            @endforeach
        </div>

    <!-- 右側 -->
    <div class="w-3/4 p-4 overflow-y-auto overflow-y-auto">
        <div class="my-4">
            <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">トレーニング中</h1>
        </div>
        
        <form action="/training/menu/{{ $checks->first()->menu->part_id }}/end" method="POST">
            @foreach($checks as $check)
                <div class="bg-white p-2 mb-2 w-1/2 mx-auto">
                    <div class="text-gray-800 font-bold font-mono text-left text-xl">
                        @csrf
                        <input type="checkbox" name="check[menu_id][]" value="{{ $check->menu_id }}"> 
                        {{ $check->menu->name }} : {{ $check->menu->weight }} kg
                    </div>
                </div>
            @endforeach
            <div class="flex justify-center">
              <input class="border-4 border-solid border-blue-500 bg-blue-200 p-2 m-3 text-center text-5xl" type="submit" value="終了">
            </div>
        </form>
    </div>
    
    <script>
        // フォルダ追加ボタンがクリックされたときの処理
        document.getElementById('add-part-button').addEventListener('click', function() {
            const partName = prompt("フォルダ名を入力してください:");
            const userId = {!! json_encode(Auth::id()) !!};
            console.log(partName, userId);
            
            // FormDataオブジェクトを作成してデータを追加
            if(partName) {
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
            }
        });
    </script>
</x-app-layout>
