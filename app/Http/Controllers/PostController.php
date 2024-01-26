<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Part;
use App\Models\Check;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // トレーニング投稿画面へ
    public function trainingPostShow() {
        $parts = Part::where("user_id", Auth::id())->get();
        $postBody = "トレーニング終了！" . "\n";
        
        $latestCheck = Check::where("user_id", Auth::id())->latest("updated_at")->first();      // 最も新しいもの(投稿するcheckを1個)を取り出す
        $endChecks = Check::where("updated_at", $latestCheck->updated_at)->get();       // updated_atが同じものが投稿するcheck
        //dd($endChecks);
        foreach($endChecks as $endcheck) {
            $endmenu = Menu::where("id", $endcheck->menu_id)->first();
            //dd($endmenu);
            $postBody .= $endmenu->name . ":" . $endmenu->weight . "kg\n";
        }

        return view("training.post")->with(["postBody" => $postBody, "parts" => $parts]);
    }
    
    // 自由な投稿
    public function normalPostShow() {
        return view("friend.post");
    }

    // 投稿をpostsテーブルに追加
    public function postPost(Request $request) {
        $post_body = $request['post_body'];
        // 追加
        $post = new Post();
        $post->user_id = Auth::id();
        $post->body = $post_body;
        $post->save();

        return redirect('/friend/index');
    }
}