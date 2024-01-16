<x-app-layout>
    <x-slot name="title">トレーニング</x-slot>
    <div class="menus">
        <div class="chest">
            @foreach($parts as $part)
                <a href="/training/menu/{{ $part->id }}">{{ $part->name }}</a>
                @foreach($menus as $menu)
                    @if($menu->part_id == $part->id)
                        <h1>{{ $menu->name }} : {{ $menu->weight }} kg</h1>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</x-app-layout>
