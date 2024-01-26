<x-app-layout>
    <x-slot name="title">メニュー</x-slot>
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
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">{{ $selectedPart->name }}</h1>
            </div>
            
            <form action="/training/menu/{{ $selectedPart->id }}/start" method="POST">
                @foreach($menus as $menu)
                    @if($menu->part_id == $selectedPart->id)
                        <div class="bg-white p-2 mb-2 w-1/2 mx-auto">
                            <div class="text-gray-800 font-bold font-mono text-left text-xl">
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
            
            <div class="flex justify-end">
                <button id="add-button" class="border-4 border-solid border-gray-500 bg-white p-2 mr-2 my-3 font-mono text-center text-3xl">
                    メニュー追加
                </button>
            </div>
            
            <div id="add-menu-modal" class="hidden">
                <div class="my-5 p-3 m-auto border-4 border-solid border-gray-500 bg-white w-1/2">
                    <form action="/training/add" method="POST">
                        @csrf
                        <input type="hidden" name="menu[part_id]" value="{{ $selectedPart->id }}"/>
                        <div class="text-gray-800 font-bold text-3xl text-left">メニュー名</div>
                        <input class="flex justify-end" type="text" name="menu[name]" placeholder="メニュー名"/>
                        <div class="text-gray-800 font-bold text-3xl text-left">重量</div>
                        <input class="flex justify-end" type="text" name="menu[weight]" placeholder="重量 kg"/>
                        
                        <div class="flex justify-center mt-2">
                            <input class="border-4 border-solid border-gray-500 bg-blue-200 p-2 m-3 font-mono text-center text-5xl" type="submit" value="追加">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // 追加ボタンがクリックされたときの処理
        document.getElementById('add-button').addEventListener('click', function() {
            let menuName = prompt("メニュー名を入力してください:");
            let menuWeight = prompt("重量(kg)を入力してください:");
            const selectedPartId = {!! json_encode($selectedPart->id) !!};
        
            // FormDataオブジェクトを作成してデータを追加
            const formData = new FormData();
            formData.append('menu[name]', menuName);
            formData.append('menu[weight]', menuWeight);
            formData.append('menu[part_id]', selectedPartId);
        
            // XMLHttpRequestを作成してPOSTリクエストを送信
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/training/add');
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