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
            <ul>
                @foreach($endChecks as $endCheck)
                    {{ $endCheck->menu->name }} : {{ $endCheck->menu->weight }} kg
                @endforeach
            </ul>
        </body>
        <div class="footer">
            <a href="/training/index">戻る</a>
        </div>
    </html>
</x-app-layout>