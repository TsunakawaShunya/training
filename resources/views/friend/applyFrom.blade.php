<x-app-layout>
    <x-slot name="title">自分宛のフレンド申請一覧</x-slot>
    <div class="title">
        <h1>自分宛のフレンド申請一覧</h1>
    </div>

    @foreach($users as $user)
        <ul>
            {{ $user->id_from }}
            <form action="/friend/apply/complete" method="POST">
                @csrf
                <input type="hidden" name="id_to" value="{{ $user->id_from }}"/>
                <input type="submit" value="許可">
            </form>
        </ul>
    @endforeach
</x-app-layout>