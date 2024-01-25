<x-app-layout>
    <x-slot name="title">フレンド申請中のユーザー一覧</x-slot>
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
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">フレンド一覧</h1>
            </div>

            @foreach($appliesTo as $applyTo)
                <div class="bg-white p-2 mb-2 text-lg font-bold text-center">
                    <div class="flex justify-center">
                        <h1 class="text-gray-800 font-bold font-mono text-center text-xl">ユーザーID : {{ $applyTo->id_to }}</h1>
                    </div>
                    <form class="flex justify-center" action="/friend/applyTo/cancel" method="POST">
                        @method('patch')
                        @csrf
                        <input type="hidden" name="applyTo" value="{{ $applyTo->id_to }}"/>
                        <input class="border-4 border-solid border-red-600 bg-red-200 p-2 font-mono text-center text-xl font-bold" type="submit" value="取り消し">
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

