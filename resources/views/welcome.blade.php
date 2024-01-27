<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>とれログ トップページ</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-blue-300 max-h-full">
      <header class="bg-gray-400 text-gray-800 font-bold font-mono text-3xl">
        <div class="text-center text-base p-2 flex justify-end">
          <ul>
            <li class="p-2 text-lg font-bold"><a href="/login">ログイン</a></li>
            <li class="p-2 text-lg font-bold"><a href="/register">新規登録</a></li>
          </ul>
        </div>
      </header>

      <main>
        <div class="text-gray-800 font-bold font-mono text-center text-3xl p-4">
          とれログ
        </div>
        
        <div class="text-gray-800 font-bold font-mono text-center text-xl p-4 flex justify-center">
          <ul>
            <li>
              筋トレに関するサービスを提供
            </li>
            <li>
              このアプリ１つでトレーニングの記録やフィットネスに関する情報の取得，フレンドとの切磋琢磨ができる！
            </li>
          </ul>
        </div>
        
        <div class="flex justify-end">
          <div class="bg-white p-2 mx-4 my-2 w-1/4">
            <h1 class="text-lg font-bold">テストユーザー</h1>
            <div class="text-center">test01</div>
            <h1 class="text-lg font-bold">メールアドレス</h1>
            <div class="text-center">test01@mail.com</div>
            <h1 class="text-lg font-bold">パスワード</h1>
            <div class="text-center">test01test01</div>
            <div class="text-end">
              <a class="font-bold" href="/login">ログインへ</a>
            </div>
          </div>
        </div>
      </main>
    </body>
</html>
