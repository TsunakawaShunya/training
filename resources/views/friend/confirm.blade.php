<x-app-layout>
    <x-slot name="title">フレンド申請</x-slot>
    <div class="title">
        <h1>フレンド申請確認</h1>
    </div>

    <div class="comfirm">
        <h2>{{ $user->name }}さんにフレンド申請しますか？</h2>
    </div>
    
    <form action="/friend/apply/complete" method="POST">
        @csrf
        <input type="hidden" name="id_to" value="{{ $user->id }}"/>
        <input type="submit" value="申請">
    </form>

    <div class="footer">
        <a href="/friend/index">戻る</a>
    </div>
</x-app-layout>

