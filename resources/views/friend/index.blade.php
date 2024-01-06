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
            <div class='myid'>
                <h1>マイID:{{ Auth::user()->id }}</h1>
            </div>

            <div class='friend-list'>
                <h1>フレンドリスト</h1>
            </div>
            
            <div class="apply">
                <a href="/friend/apply">フレンド申請</a>
            </div>
            
            <div class="apply-to-list">
                <a href="/friend/applyTo">フレンド申請中のユーザー一覧</a>
            </div>
            
            <div class="apply-from-list">
                <a href="/friend/applyFrom">自分宛のフレンド申請一覧</a>
            </div>
            
        </body>
    </html>
</x-app-layout>

