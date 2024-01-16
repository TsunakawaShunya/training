<x-app-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <title>Training</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        </head>
        <body>
            <div class="title">
                <h1>フレンド</h1>
            </div>
            
            <div class="myid">
                <h1>マイID:{{ Auth::user()->id }}</h1>
            </div>

            <div class='friend-list'>
                <a href="/friend/list">フレンドリスト</a>
            </div>
            
            <div class="apply">
                <a href="/friend/apply">フレンド申請</a>
            </div>
            
            <div class="apply-to">
                <a href="/friend/applyTo">フレンド申請中のユーザー一覧</a>
            </div>
            
            <div class="apply-from">
                <a href="/friend/applyFrom">自分宛のフレンド申請一覧</a>
            </div>
            
            <div class="post-list">
               <h1>ポスト一覧</h1>
                @foreach($posts as $post)
                    <div class="post">
                        {{ $post->user->name }}<br>
                        {{ $post->body }}
                    </div>
                    
                    <form action="/friend/post/like" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit">いいね</button>
                        {{ $likes->where("post_id", $post->id)->count() }}
                    </form>

                @endforeach
                <a href="/friend/post">投稿</a>
            </div>
        </body>
    </html>
</x-app-layout>