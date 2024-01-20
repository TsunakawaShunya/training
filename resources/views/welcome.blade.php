<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>とれログ トップページ</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
      <header class="bg-gray-400 text-gray-800 font-bold font-mono text-center text-3xl">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          とれログ
        </div>
      </header>

      <main class="bg-blue-300 max-h-full">
        <div class="flex justify-center text-gray-800 text-center text-base">
          <ul>
            <li class="p-2"><a href="/login">ログイン</a></li>
            <li class="p-2"><a href="/register">新規登録</a></li>
          </ul>
        </div>
      </main>
    </body>
</html>
