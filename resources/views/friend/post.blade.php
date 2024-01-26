<x-app-layout>
    <x-slot name="title">投稿</x-slot>
    <x-slot name="header">フレンド</x-slot>

    <div class="flex">
        <!-- 左側のメニュー -->
        <div class="w-1/4 p-4 bg-gray-400">
            <div class="mb-4  text-lg font-bold">
                <h1>ID : {{ Auth::user()->id }}</h1>
                <h1>名前 : {{ Auth::user()->name }}</h1>
            </div>

            <div class='mb-2 text-lg font-bold'>
                <a href="/friend/index">ポスト一覧</a>
            </div>

            <div class='mb-2 text-lg font-bold'>
                <a href="/friend/list">フレンドリスト</a>
            </div>

            <div class="mb-2 text-lg font-bold">
                <a href="/friend/apply">フレンド申請</a>
            </div>

            <div class="mb-2 text-lg font-bold">
                <a href="/friend/applyTo">フレンド申請中のユーザー一覧</a>
            </div>

            <div class="mb-2 text-lg font-bold">
                <a href="/friend/applyFrom">自分宛のフレンド申請一覧</a>
            </div>
        </div>
    
        <!-- 右側 -->
        <div class="w-3/4 p-4">
            <div class="my-4">
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">投稿</h1>
            </div>
            
            <form action="/training/post/post" method="POST">
                <div class="bg-white p-2 mb-2 w-1/2 mx-auto">
                    <div class="text-gray-800 font-bold font-mono text-left text-xl">
                        @csrf
                        <textarea rows="4" class="block p-2.5 w-full" name="post_body"></textarea>
                    </div>
                </div>
                <div class="flex justify-center">
                  <input class="border-4 border-solid border-blue-500 bg-blue-200 p-2 m-3 text-center text-5xl" type="submit" value="投稿">
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
