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
                <h1>フレンド申請</h1>
            </div>
            
            <div class='myid'>
                <h1>マイID</h1>
                {{ Auth::user()->id }} 
            </div>
            
            <div class="friend-apply">
                <form action="/friend/apply/confirm" method="POST">
                    @csrf
                    <h2>ID</h2>
                    <input type="text" name="user_id" placeholder="相手のID"/>
                    <input type="submit" value="検索">
                </form>
            </div>
        </body>
    </html>
</x-app-layout>

