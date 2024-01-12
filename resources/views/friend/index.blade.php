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
                Posts
                @foreach($posts as $post)
                    <div class="post">
                        {{ $post->user->name }}<br>
                        {{ $post->body }}
                    </div>
                @endforeach
            </div>
        </body>
    </html>
</x-app-layout>