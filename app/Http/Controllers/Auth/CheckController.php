<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Check;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    // check->statusを更新
    public function check(Request $request, Check $check) {
        $check = $request['check'];
    }
    
    // check->status=1のメニューをviewに渡す
    public function check_training(Check $checks, Menu $menu) {
        $menu = Menu::where('user_id', Auth::id())->where('id', $checks->menu_id)->get();
        return view('training.training')->with(['menus' => $menu->get()]);
    }
}