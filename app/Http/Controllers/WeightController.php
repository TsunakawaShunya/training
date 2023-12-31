<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use Illuminate\Support\Facades\Auth;

class WeightController extends Controller
{
    // 体重get部
    public function show() {
        $weightLog = Weight::where("user_id", Auth::id())->get();
        return view("home.index")->with(["weightLog" => $weightLog]);
    }
    
    // 体重ログの追加
    public function add(Request $request) {
        $input = $request->input('weight');
        $latestWeight = Weight::where('user_id', Auth::id())->latest('id')->first();
        
        if($latestWeight->created_at->toDateString() == now()->toDateString()) {
            $weightLog = $latestWeight;
            $weightLog->fill($input)->save();
        }
        else {
            $weightLog = new Weight();
            $weightLog->user_id = Auth::id();
            $weightLog->fill($input)->save();
        }
        return redirect('/home/index');
    }
}