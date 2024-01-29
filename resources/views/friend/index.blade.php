<x-app-layout>
    <x-slot name="title">フレンド</x-slot>
    <x-slot name="header">フレンド</x-slot>

    <div class="flex h-screen">
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

        <!-- 右側のポスト一覧 -->
        <div class="w-3/4 p-4 overflow-y-auto">
            <div class="my-4">
                <h1 class="text-gray-800 font-bold font-mono text-center text-3xl">ポスト一覧</h1>
                <a href="/friend/post" class="bg-green-700 text-lg text-white px-4 py-2">投稿</a>
            </div>
            @foreach($postsList as $post)
                <div class="bg-white p-2 mb-2">
                    <h1 class="text-lg font-bold">{{ $post->user->name }}</h1>
                    <div class="text-sm">{{ $post->updated_at }}</div>
                    <div class="text-center">{{ $post->body }}</div>
                    <form action="/friend/post/like" method="POST" class="mb-2 flex justify-end">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="px-4 mb-2">
                            @if($post->likes->contains('user_id', Auth::id()))
                                <div class="text-red-500">いいね</div> <!-- いいね済み -->
                            @else
                                <div class="text-gray-800">いいね</div> <!-- 未いいね -->
                            @endif
                        </button>                        
                        <div class="mr-2 ">{{ $post->likes->count() }}</div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
