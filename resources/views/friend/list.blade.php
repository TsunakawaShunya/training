<x-app-layout>
    <x-slot name="title">フレンド一覧</x-slot>
    <div class="title">
        <h1>フレンド一覧</h1>
    </div>
    
    @foreach($friends as $friend)
        <li>
            id:{{ $friend['id'] }}
            名前:{{ $friend['name'] }}
        </li>
    @endforeach
</x-app-layout>

