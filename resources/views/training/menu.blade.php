<x-app-layout>
    <x-slot name="title">メニュー</x-slot>
    <x-slot name="header">トレーニング</x-slot>

    <div class="text-gray-800 font-bold text-5xl text-left">{{ $part->name }}</div>

    <form action="/training/menu/{{ $part->id }}/start" method="POST">
        @foreach($menus as $menu)
            @if($menu->part_id == $part->id)
                <ul>
                    @csrf
                    <div class="flex justify-center">
                        <input type="checkbox" name="menu[id][]" value="{{ $menu->id }}"> 
                        {{ $menu->name }} : {{ $menu->weight }} kg
                    </div>
                </ul>
            @endif
        @endforeach
        <div class="flex justify-center mt-2">
            <input class="border-4 border-solid border-red-500 bg-red-200 p-2 text-center text-5xl" type="submit" value="開始">
        </div>
    </form>
    
    <div class="m-5 p-3 m-auto border-4 border-solid border-gray-500 w-1/2">
        <form action="/training/index" method="POST">
            @csrf
            <input type="hidden" name="menu[part_id]" value="{{ $part->id }}"/>
            <input type="hidden" name="menu[user_id]" value="{{ Auth::id() }}"/>
        
            <div>
                <div class="text-gray-800 font-bold text-3xl text-left">メニュー名</div>
                <input class="flex justify-end" type="text" name="menu[name]" placeholder="メニュー名"/>
                <div class="text-gray-800 font-bold text-3xl text-left">重量</div>
                <input class="flex justify-end" type="text" name="menu[weight]" placeholder="重量 kg"/>
            </div>
            
            <div class="flex justify-center mt-2">
                <input class="border-4 border-solid border-orange-500 bg-orange-200 p-2 m-3 text-center text-5xl" type="submit" value="追加">
            </div>
        </form>
    </div>
</x-app-layout>