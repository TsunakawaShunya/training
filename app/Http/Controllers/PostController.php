<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postShow() {
        
    }

    public function trainingPost(Request $request) {
        $input = $request['endmenu'];
        dd($input);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->body = "トレーニング終了！" . "\n";
        
    }
}