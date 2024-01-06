<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calorie;
use Illuminate\Support\Facades\Auth;

class CalorieController extends Controller
{

    // カロリーログの追加
    public function add(Request $request) {
        $input = $request->input('calorie');
        
        if(Calorie::where('user_id', Auth::id())->latest('id')->first() == null) {
            $latestCalorie = new Calorie();
            $latestCalorie->user_id = Auth::id();
            $latestCalorie->carbohydrate = 0;
            $latestCalorie->protain = 0;
            $latestCalorie->fat = 0;
            $latestCalorie->save();
        } else {
            $latestCalorie = Calorie::where('user_id', Auth::id())->latest('id')->first();
        }
        //dd($latestCalorie);

        if($latestCalorie->created_at->toDateString() == now()->toDateString()) {
            $calorieLog = $latestCalorie;
            $calorieLog->carbohydrate += $input['carbohydrate'];
            $calorieLog->protain += $input['protain'];
            $calorieLog->fat += $input['fat'];
            $calorieLog->save();
        }
        else {
            $calorieLog = new Calorie();
            $calorieLog->user_id = Auth::id();
            $calorieLog->fill($input)->save();
        }
        return redirect('/home/index');
    }
}