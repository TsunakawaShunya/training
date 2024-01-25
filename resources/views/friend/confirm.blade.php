<x-app-layout>
    <x-slot name="title">フレンド申請確認</x-slot>
    <x-slot name="header">フレンド</x-slot>

    <div class="flex">
        <!-- 左側のメニュー -->
        <div class="w-1/4 p-4 bg-gray-400">
            <div class="mb-4  text-lg font-bold">
                <h1>ID : {{ Auth::user()->id }}</h1>
                <h1>名前 : {{ Auth::user()->name }}</h1>
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
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">フレンド申請確認</h1>
            </div>
            
            <div class="border-4 border-solid border-gray-800 bg-white w-1/2 mx-auto px-4 py-2 mb-2">
                <div class="text-center">
                    <div class="text-gray-800 font-bold font-mono text-center text-xl">{{ $user->name }}さん</div>
                    <div>にフレンド申請しますか？</div>
                </div>
    
                <form class="flex justify-center" action="/friend/apply/complete" method="POST">
                    @csrf
                    <input type="hidden" name="id_to" value="{{ $user->id }}"/>
                    <input class="border-4 border-solid border-blue-600 bg-blue-100 p-2 font-mono text-center text-xl font-bold" type="submit" value="申請">
                </form>
            </div>
        
            <div class="footer">
                <a href="/friend/index">戻る</a>
            </div>
        </div>
    </div>

</x-app-layout>

