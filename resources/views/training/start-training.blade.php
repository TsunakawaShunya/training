<x-app-layout>
    <x-slot name="title">トレーニング中</x-slot>
    <body>
        <div class="menu">
            <form action="/training/menu/{{ $checks->first()->menu->part_id }}/end" method="POST">
                @foreach($checks as $check)
                    <ul>
                        @csrf
                        <input type="checkbox" name="check[menu_id][]" value="{{ $check->menu_id }}">
                        {{ $check->menu->name }} : {{ $check->menu->weight }} kg
                    </ul>
                @endforeach
                <input type="submit" value="終了">
            </form>
        </div>
</x-app-layout>