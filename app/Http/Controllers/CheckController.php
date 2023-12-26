<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Check;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    // トレーニング開始
    public function postStart(Request $request) {
        $inputMenus = $request->input('menu');
        $userId = Auth::id();
        
        // 登録レコードすべてのstatusを0にする
        Check::query()->update(['status' => 0]);

        foreach ($inputMenus['id'] as $menuId) {
            $check = new Check();
            $check->menu_id = $menuId;
            $check->user_id = $userId;
            $check->status = 1;
            $check->save();
        }

        $partId = Menu::find($check->menu_id)->part_id;
        return redirect('/training/menu/' . $partId . '/start');
    }

    public function showStart() {
        $checks = Check::where("user_id", Auth::id())->where("status", 1)->get();
        return view('training.start-training')->with(['checks' => $checks]);
    }
    
    // トレーニング終了post部
    public function postEnd(Request $request) {
        $inputMenus = $request->input('check');
        $userId = Auth::id();
        
        // トレーニングが終了したものはstatusを0にする
        foreach($inputMenus['menu_id'] as $menuId) {
            $endCheck = new Check();
            $endCheck = Check::where("user_id", Auth::id())->where("menu_id", $menuId)->where("status", 1)->first();
            //dd($endCheck);
            $endCheck->status = 0;
            $endCheck->save();
            
        }
        
        $partId = Menu::find(Check::where("updated_at", now())->first()->menu_id)->part_id;
        return redirect('/training/menu/' . $partId . '/end');
    }
    
    // トレーニング終了get部
    public function showEnd() {
        $endChecks = Check::where("user_id", Auth::id())->where("updated_at", now())->get();
        return view("training.end-training")->with(['endChecks' => $endChecks]);
    }
}