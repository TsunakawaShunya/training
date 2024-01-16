<x-app-layout>
    <x-slot name="title">フレンド申請中のユーザー一覧</x-slot>
    <div class="title">
        <h1>フレンド申請中のユーザー一覧</h1>
    </div>

    @foreach($appliesTo as $applyTo)
        <ul>
            {{ $applyTo->id_to }}
            <form action="/friend/applyTo/cancel" method="POST">
                @method('patch')
                @csrf
                <input type="hidden" name="applyTo" value="{{ $applyTo->id_to }}"/>
                <input type="submit" value="取り消し">
            </form>
        </ul>
    @endforeach
</x-app-layout>

