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
            <div class="title">
                <h1>フレンド申請中のユーザー一覧</h1>
            </div>

            @foreach($appliesTo as $applyTo)
                <ul>
                    {{ $applyTo->id_to }}
                    <form action="/friend/applyTo/cancel" method="POST">
                        @method('patch')
                        @csrf
                        <input type="hidden" name="applyTo" value="{{ $applyTo->id_to }}"/>
                        <input type="submit" value="取り消し">
                    </form>
                </ul>
            @endforeach
        </body>
    </html>
</x-app-layout>

