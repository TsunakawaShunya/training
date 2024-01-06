<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    // get
    public function showIndex() {
        return view('friend.index');
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
        return view('friend.applyTo')->with(["users" => $applyTo]);
    }

    public function applyFrom() {
        $applyFrom = Friend::where("id_to", Auth::id())->get();     // 自分宛に申請中のユーザー
        return view('friend.applyFrom')->with(["users" => $applyFrom]);
    }

    // post
    public function submitConfirmApply(Request $request) {
        $input = $request['user_id'];
        $user = User::find($input);
        
        session(['user' => $user]);
        
        return redirect('/friend/apply/confirm');
    }
    
    public function submitApply(Request $request) {
        $input = $request['id_to'];
        $friend = new Friend();
        $friend->id_from = Auth::id();
        $friend->id_to = $input;
        $friend->save();
        
        return redirect('/friend/index');
    }
}