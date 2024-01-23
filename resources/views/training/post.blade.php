<x-app-layout>
    <x-slot name="title">投稿</x-slot>
    <div class="p-3">
        <form action="/training/post/post" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}"/>
            <div class="flex justify-center">
                <textarea class="w-8/10" name="post_body">{{ $post->body }}</textarea>
            </div>
            
            <div class="flex justify-end">
                <input class="border-4 border-solid border-gray-500 bg-gray-200 p-2 m-3 font-mono text-center text-5xl" type="submit" value="投稿">
            </div>
        </form>
    </div>
</x-app-layout>
