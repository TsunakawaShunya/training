<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Check;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postShow() {
        $latestCheck = Check::where("user_id", Auth::id())->latest("updated_at")->first();      // 最も新しいもの(投稿するcheckを1個)を取り出す
        $endChecks = Check::where("updated_at", $latestCheck->updated_at)->get();       // updated_atが同じものが投稿するcheck
        //dd($endChecks);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->body = "トレーニング終了！\n";
        foreach($endChecks as $endcheck) {
            $endmenu = Menu::where("id", $endcheck->menu_id)->first();
            //dd($endmenu);
            $post->body .= $endmenu->name . ":" . $endmenu->weight . "kg\n";
        }
        $post->save();
        
        return view("training.post")->with(["post" => $post]);
    }
    
    public function postPost(Request $request) {
        $post_id = $request['post_id'];
        $post_body = $request['post_body'];
        
        $post = Post::find($post_id);
        $post->body = $post_body;
        $post->save();
        
        return redirect('/home/index');
    }
}