<x-app-layout>
    <x-slot name="title">メニュー</x-slot>
    <x-slot name="header">トレーニング</x-slot>

    <div class="flex h-screen">
        <!-- 左側 -->
        <div class="w-1/4 p-4 bg-gray-400 overflow-y-auto">
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
        <div class="w-3/4 p-4 overflow-y-auto">
            <div class="my-4">
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">{{ $selectedPart->name }}</h1>
            </div>
            
            <div class="flex justify-end">
                <button id="add-menu-button" class="p-2 mr-2 my-3 font-mono text-center text-3xl">
                    <svg class="h-10 w-10 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </button>
            </div>
            
            <form action="/training/menu/{{ $selectedPart->id }}/start" method="POST" onsubmit="validateForm(event)">
                @foreach($menus as $menu)
                    @if($menu->part_id == $selectedPart->id)
                        <div class="bg-white p-2 mb-2 w-1/2 mx-auto">
                            <div class="text-gray-800 font-bold font-mono text-left text-xl">
                                @csrf
                                <input type="checkbox" name="menu[id][]" value="{{ $menu->id }}"> 
                                {{ $menu->name }} : {{ $menu->weight }} kg
                            </div>
                        </div>
                    @endif
                @endforeach
                
                <div class="flex justify-center">
                  <input class="border-4 border-solid border-blue-600 bg-white p-2 font-mono text-center text-5xl" type="submit" value="開始">
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // チェックついてないとき
        function validateForm(event) {
            // チェックボックスの要素を取得
            const checkboxes = document.querySelectorAll('input[name^="menu[id][]"]');
            
            // チェックが一つも選択されていない場合にアラートを表示
            if (!Array.from(checkboxes).some(checkbox => checkbox.checked)) {
                alert('メニューを選択してください');
                event.preventDefault(); // フォームの送信を中止
            }
        }

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

        // メニュー追加ボタンがクリックされたときの処理
        document.getElementById('add-menu-button').addEventListener('click', function() {
            const menuName = prompt("メニュー名を入力してください:");
            const menuWeight = prompt("重量(kg)を入力してください:");
            const selectedPartId = {!! json_encode($selectedPart->id) !!};
        
            // FormDataオブジェクトを作成してデータを追加
            const formData = new FormData();
            formData.append('menu[name]', menuName);
            formData.append('menu[weight]', menuWeight);
            formData.append('menu[part_id]', selectedPartId);
        
            // XMLHttpRequestを作成してPOSTリクエストを送信
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/training/menu/add');
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