<x-app-layout>
    <x-slot name="title">トレーニング終了</x-slot>
    <div class="text-gray-800 font-bold font-mono text-center text-3xl p-4">お疲れさまでした！</div>
    @foreach($endChecks as $endCheck)
        <ul>
            <div class="text-gray-800 text-center text-xl p-4">
                {{ $endCheck->menu->name }} : {{ $endCheck->menu->weight }} kg
            </div>
        </ul>
    @endforeach

    <div class="flex justify-center space-x-5 m-5">
        <a class="border-4 border-solid border-gray-500 bg-gray-200 p-2 m-3 text-center text-5xl" href="/training/post">投稿</a>
        <a class="border-4 border-solid border-gray-500 bg-gray-200 p-2 m-3 text-center text-5xl" href="/training/index">戻る</a>
    </div>
</x-app-layout>