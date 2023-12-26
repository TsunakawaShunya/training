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
            <div class="menu">
                <h1>トレーニング中</h1>
                <form action="/training/menu/{{ $checks->first()->menu->part_id }}/end" method="POST">
                    @foreach($checks as $check)
                        <ul>
                            @csrf
                            <input type="checkbox" name="check[menu_id][]" value="{{ $check->menu_id }}">
                            {{ $check->menu->name }} : {{ $check->menu->weight }} kg
                        </ul>
                    @endforeach
                    <input type="submit" value="終了">
                </form>
            </div>
        </body>
        <div class="footer">
            <a href="/training/index">戻る</a>
        </div>
    </html>
</x-app-layout>