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
                <h1>フレンド一覧</h1>
            </div>
            
            @foreach($friends as $friend)
                <li>
                    id:{{ $friend->id }}
                    名前:{{ $friend->name }}
                </li>
            @endforeach
        </body>
    </html>
</x-app-layout>

