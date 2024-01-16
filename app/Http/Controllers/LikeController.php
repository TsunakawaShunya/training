<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // いいね追加
    public function addLike(Request $request) {
        $post_id = $request->input('post_id');
        $user_id = Auth::id();
        
        $like = new Like();
        $like->post_id = $post_id;
        $like->user_id = $user_id;
        $like->save();

        return redirect('/friend/index');
    }

}