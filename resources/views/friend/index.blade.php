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
                <h1>マイID</h1>
                {{ Auth::user()->id }} 
            </div>

            <div class='friend-list'>
                <h1>フレンドリスト</h1>
                <a href="/friend/apply">フレンド申請</a>
            </div>
        </body>
    </html>
</x-app-layout>

