<x-app-layout>
    <x-slot name="title">トレーニング</x-slot>
      <x-slot name="header">トレーニング</x-slot>

        @foreach($parts as $part)
            <div class="border border-3 border-gray-800 p-1 mt-1">
                <a class="bg-gray-200 text-gray-800 font-bold font-mono text-center text-3xl" href="/training/menu/{{ $part->id }}">{{ $part->name }}</a>
                @foreach($menus as $menu)
                    <div class="text-gray-800 font-mono text-center text-base">
                        @if($menu->part_id == $part->id)
                            <h1>{{ $menu->name }} : {{ $menu->weight }} kg</h1>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
</x-app-layout>
