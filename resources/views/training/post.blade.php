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
            <div class="create-post">
                <form action="/training/post/post" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                    <textarea name="post_body">{{ $post->body }}</textarea>
                    <input type="submit" value="投稿">
                </form>
            </div>
        </body>
    </html>
</x-app-layout>
