<x-app-layout>
    <x-slot name="title">フレンド申請</x-slot>
    <div class="title">
        <h1>フレンド申請</h1>
    </div>
    
    <div class='myid'>
        <h1>マイID</h1>
        {{ Auth::user()->id }} 
    </div>
    
    <div class="friend-apply">
        <form action="/friend/apply/confirm" method="POST">
            @csrf
            <h2>ID</h2>
            <input type="text" name="user_id" placeholder="相手のID"/>
            <input type="submit" value="検索">
        </form>
    </div>
</x-app-layout>

