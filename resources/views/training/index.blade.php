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
        </body>
    </html>
</x-app-layout>
