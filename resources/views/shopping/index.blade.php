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
            <div class='greeting'>
                <h1>ショッピング</h1>
                <h1>こんにちは！{{ Auth::user()->name }} さん！</h1>
            </div>
            
            <div class='rakuten'>
                <form action="/shopping/index" method="POST">
                    @csrf
                    <input type="text" name="keyword[]" placeholder="検索"/>
                    <ul>
                        <input type="checkbox" name="keyword[]" value="プロテイン"> 
                        プロテイン
                    </ul>
                    <ul>
                        <input type="checkbox" name="keyword[]" value="サプリメント"> 
                        サプリメント
                    </ul>
                    <ul>
                        <input type="checkbox" name="keyword[]" value="フィットネスグッズ"> 
                        フィットネスグッズ
                    </ul>
                    <ul>
                        <input type="checkbox" name="keyword[]" value="スポーツウェア"> 
                        スポーツウェア
                    </ul>
                    <input type="submit" value="検索">
                </form>
                @if($items == null)
                    <h1></h1>
                @else
                    @foreach($items as $item)
                        <li class="item">
                            <ul>
                                <img src="{{ $item['mediumImageUrls'] }}" alt="{{ $item['itemName'] }}の画像">
                            </ul>
                            <ul>
                                <a href="{{ $item['itemUrl'] }}" target="_blank">
                                    {{ $item['itemName'] }}
                                </a>
                            </ul>
                            <ul>
                                価格：{{ $item['itemPrice'] }}円
                            </ul>
                        </li>
                    @endforeach
                @endif
            </div>
        </body>
    </html>
</x-app-layout>

