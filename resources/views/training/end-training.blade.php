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
            <h1>お疲れさまでした！</h1>
            @foreach($endChecks as $endCheck)
                <ul>
                    {{ $endCheck->menu->name }} : {{ $endCheck->menu->weight }} kg
                </ul>
            @endforeach
        </body>
        
        <div class="goto-post">
            <a href="/training/post">投稿する</a>
        </div>
        <div class="footer">
            <a href="/training/index">戻る</a>
        </div>
    </html>
</x-app-layout>