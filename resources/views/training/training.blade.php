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
            <h1>トレーニング中</h1>
            @foreach($menus as $menu)
                <ul>
                    {{ $menu->name }} : {{ $menu->weight }} kg
                </ul>
            @endforeach
        </body>
        <div class="footer">
            <a href="/start-training">戻る</a>
        </div>
    </html>
</x-app-layout>