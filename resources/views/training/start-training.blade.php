<x-app-layout>
    <x-slot name="title">トレーニング中</x-slot>
    <body>
        <form action="/training/menu/{{ $checks->first()->menu->part_id }}/end" method="POST">
            @foreach($checks as $check)
                <ul>
                    @csrf
                    <div class="flex justify-center">
                        <input type="checkbox" name="check[menu_id][]" value="{{ $check->menu_id }}">
                        {{ $check->menu->name }} : {{ $check->menu->weight }} kg
                    </div>
                </ul>
            @endforeach
            <div class="flex justify-center">
                <input class="border-4 border-solid border-blue-500 bg-blue-200 p-2 m-3 text-center text-5xl" type="submit" value="終了">
            </div>
        </form>
</x-app-layout>