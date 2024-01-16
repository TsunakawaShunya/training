<x-app-layout>
    <x-slot name="title">投稿</x-slot>
    <div class="create-post">
        <form action="/training/post/post" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}"/>
            <textarea name="post_body">{{ $post->body }}</textarea>
            <input type="submit" value="投稿">
        </form>
    </div>
</x-app-layout>
