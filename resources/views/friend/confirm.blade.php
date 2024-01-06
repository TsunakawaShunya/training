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
            <div class="comfirm">
                <h2>{{ $user->name }}さんにフレンド申請しますか？</h2>
            </div>
            
            <form action="/friend/apply/complete" method="POST">
                @csrf
                <input type="hidden" name="id_to" value="{{ $user->id }}"/>
                <input type="submit" value="申請">
            </form>
        </body>
        
        <div class="footer">
            <a href="/friend/index">戻る</a>
        </div>
    </html>
</x-app-layout>

