<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Part;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function show(Menu $menu, Part $part) {
        return view('training.start-training')->with(['parts' => $part->get(), 'menus' => $menu::where('user_id', Auth::id())->get()]);
    }
    
    public function add(Part $part) {
        $menu = Menu::where('user_id', Auth::id())->where('part_id', $part->id)->get();
        return view('training.menu')->with(['menus' => $menu, 'part' => $part]);
    }
    
    public function store(Request $request, Menu $menu){
        $input = $request['menu'];
        
        // 追加
        $menu->fill($input)->save();
        
        return redirect('/start-training');
    }
}