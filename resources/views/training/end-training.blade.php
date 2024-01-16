<x-app-layout>
    <x-slot name="title">トレーニング終了</x-slot>
    <h1>お疲れさまでした！</h1>
    @foreach($endChecks as $endCheck)
        <ul>
            {{ $endCheck->menu->name }} : {{ $endCheck->menu->weight }} kg
        </ul>
    @endforeach

    <div class="goto-post">
        <a href="/training/post">投稿する</a>
    </div>
    <div class="footer">
        <a href="/training/index">戻る</a>
    </div>
</x-app-layout>