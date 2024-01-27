<x-app-layout>
    <x-slot name="title">ショッピング</x-slot>
    <x-slot name="header">ショッピング</x-slot>
    <div class="p-3">
        <!-- 
        <img class="ml-4" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.rakuten.co.jp%2F&psig=AOvVaw3eTVpBfgYNx1gMjnwW70nb&ust=1706250489205000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCJCY7b_z94MDFQAAAAAdAAAAABAD" alt="楽天市場ロゴ">
        -->
      <div class="m-2 text-lg text-center font-bold">
        トレーニングに関する楽天の商品ページを表示しています</br>
        気になる商品のリンクをクリックすると楽天のページへ遷移します
      </div>
    </div>
    
    <div id='rakuten'>
        <form action="/shopping/index" method="POST">
            @csrf
            <div class="flex justify-center">
                <input class="border-3 border-solid border-gray-800 w-4/5" type="text" name="keyword[]" placeholder="検索"/>
            </div>
            <ul class="w-1/6 ml-auto text-lg font-bold">
              <li>
                <input type="checkbox" name="keyword[]" value="プロテイン"> 
                プロテイン
              </li>
              <li>
                <input type="checkbox" name="keyword[]" value="サプリメント"> 
                サプリメント
              </li>
              <li>
                <input type="checkbox" name="keyword[]" value="フィットネスグッズ"> 
                フィットネスグッズ
              </li>
              <li>
                <input type="checkbox" name="keyword[]" value="スポーツウェア"> 
                スポーツウェア
              </li>
            </ul>
            <div class="flex justify-center">
              <input class="border-4 border-solid border-blue-600 bg-white p-2 font-mono text-center text-5xl" type="submit" value="検索">
            </div>
        </form>
        
        <div class="my-3 text-center">
            @foreach($items as $item)
                <ul class="inline-flex">
                    <li>
                        <ul class="bg-white m-3 p-2">
                            <li class="text-xl">
                                {{ $item['itemPrice'] }} 円
                            </li>
                            <li>
                                <a class="mx-auto my-2" href="{{ $item['itemUrl'] }}" target="_blank">
                                    <img class="mx-auto" src="{{ $item['mediumImageUrls'] }}" alt="{{ $item['itemName'] }}の画像">
                                </a>
                            </li>
                            <li>
                                <a class="mx-auto my-2" href="{{ $item['itemUrl'] }}" target="_blank">{{ \Illuminate\Support\Str::limit($item['itemName'], 30) }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</x-app-layout>

