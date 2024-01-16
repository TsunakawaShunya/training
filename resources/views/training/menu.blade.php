<x-app-layout>
    <x-slot name="title">メニュー</x-slot>

    <div class="menus">
        <h1>{{ $part->name }}</h1>
        <form action="/training/menu/{{ $part->id }}/start" method="POST">
            @foreach($menus as $menu)
                @if($menu->part_id == $part->id)
                    <ul>
                        @csrf
                        <input type="checkbox" name="menu[id][]" value="{{ $menu->id }}"> 
                        {{ $menu->name }} : {{ $menu->weight }} kg
                    </ul>
                @endif
            @endforeach
            <input type="submit" value="開始">
        </form>
    </div>
    <form action="/training/index" method="POST">
        @csrf
        <div class="part">
            <input type="hidden" name="menu[part_id]" value="{{ $part->id }}"/>
        </div>
        <div class="user">
            <input type="hidden" name="menu[user_id]" value="{{ Auth::id() }}"/>
        </div>
        <div class="name">
            <h2>メニュー名</h2>
            <input type="text" name="menu[name]" placeholder="メニュー名"/>
        </div>
        <div class="weight">
            <h2>重量</h2>
            <input type="text" name="menu[weight]" placeholder="重量 kg"/>
        </div>
        <input type="submit" value="追加">
    </form>
</x-app-layout>