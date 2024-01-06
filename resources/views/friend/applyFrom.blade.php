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
            <h1>フレンド申請中のユーザー一覧</h1>
            @foreach($users as $user)
                <ul>
                    {{ $user->id_from }}
                    <form action="/friend/apply/complete" method="POST">
                        @csrf
                        <input type="hidden" name="id_to" value="{{ $user->id_from }}"/>
                        <input type="submit" value="許可">
                    </form>
                </ul>
            @endforeach
        </body>
    </html>
</x-app-layout>