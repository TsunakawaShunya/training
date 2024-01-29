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
                                <!-- いいね済み -->
                                <svg class="h-8 w-8 text-red-500"  fill="red" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            @else
                                <!-- 未いいね -->
                                <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            @endif
                        </button>                        
                        <div class="mr-2 ">{{ $post->likes->count() }}</div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
