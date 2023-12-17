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
            <div class="menus">
                <h1>{{ $part->name }}</h1>
                @foreach($menus as $menu)
                    @if($menu->part_id == $part->id)
                        <ul>
                            {{ $menu->name }} : {{ $menu->weight }}
                        </ul>
                    @endif
                @endforeach
            </div>
            
            <form action="/start-training" method="POST">
                @csrf
                <div class="part">
                    <input type="hidden" name="menu[part_id]" value="{{ $part->id }}"/>
                </div>
                <div class="name">
                    <h2>メニュー名</h2>
                    <input type="text" name="menu[name]" placeholder="メニュー名"/>
                </div>
                <div class="weight">
                    <h2>重量</h2>
                    <input type="text" name="menu[weight]" placeholder="重量 kg"/>
                </div>
                <input type="submit" value="追加">
            </form>
        </body>
        <div class="footer">
            <a href="/start-training">戻る</a>
        </div>
    </html>
</x-app-layout>