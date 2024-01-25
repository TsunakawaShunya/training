<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    // ----------------------------get----------------------------
    public function showIndex() {
        $friends = $this->friends();
        $posts = array();
        
        foreach($friends as $friend) {
            $post = Post::where("user_id", $friend->id)->orWhere('user_id', Auth::id())->get();
            foreach($post as $p) {
               array_push($posts, $p);
            }
        }
        // updated_at で降順にソート
        usort($posts, function($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });        
        return view("friend.index")->with(["posts" => $posts]);
    }

    public function showList() {
        $friends = $this->friends();
        return view('friend.list')->with(["friends" => $friends]);
    }

    public function showApply() {
        return view('friend.apply');
    }
    
    public function confirmApply() {
        $user = session('user');
        return view("friend.confirm")->with(["user" => $user]);
    }
    
    public function applyTo() {
        $applyTo = Friend::where("id_from", Auth::id())->get();     // 自分から申請中のユーザー
        return view('friend.applyTo')->with(["appliesTo" => $applyTo]);
    }

    public function applyFrom() {
        $applyFrom = Friend::where("id_to", Auth::id())->get();     // 自分宛に申請中のユーザー
        return view('friend.applyFrom')->with(["users" => $applyFrom]);
    }

    // ----------------------------post----------------------------
    // 申請の確認
    public function submitConfirmApply(Request $request) {
        $input = $request['user_id'];
        $user = User::find($input);
        
        session(['user' => $user]);
        
        return redirect('/friend/apply/confirm');
    }
    
    // 申請
    public function submitApply(Request $request) {
        $input = $request['id_to'];
        if(Friend::where("id_from", Auth::id())->where("id_to", $input)->first()){
            $friend = Friend::where("id_from", Auth::id())->where("id_to", $input)->first();
            $friend->created_at = now();
            $friend->save();
        }
        else {
            $friend = new Friend();
            $friend->id_from = Auth::id();
            $friend->id_to = $input;
            $friend->save();
        }
        
        return redirect('/friend/index');
    }
    
    // 申請取り消し
    public function cancelApplyTo(Request $request) {
        $input = $request['applyTo'];
        $cancelApply = Friend::where("id_to", $input)->get();     // 自分から申請中のユーザー
        $cancelApply->each->delete();       // $applyToをテーブルから削除
        
        return redirect('/friend/applyTo');
    }

    // フレンドを返す
    private function friends() {
        $friends_id = [];
        $friends = [];
        
        // 1. 自分から誰かへ申請した人たち
        $id_to_s = Friend::where("id_from", Auth::id())->get()->pluck('id_to');
        //dd($id_to_s);
        // 2. 1の人たちの中で自分に申請した人たち
        foreach($id_to_s as $id_to) {
            $friend_id = Friend::where("id_from", $id_to)->where("id_to", Auth::id())->first();
            
            if ($friend_id) {
                $friends_id[] = $friend_id->id_from;       // $friendが存在すればid_fromを配列に追加
            }
        }

        foreach($friends_id as $friend_id) {
            $friend = User::where("id", $friend_id)->first();
            
            if ($friend) {
                $friends[] = $friend;
            }
        }
        
        return $friends;
    }
}