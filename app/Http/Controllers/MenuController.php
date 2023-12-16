<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Part;

class MenuController extends Controller
{
    public function show(Menu $menu, Part $part) {
        return view('training.start-training')->with(['parts' => $part->get(), 'menus' => $menu->get()]);
    }
    
    public function add(Part $part) {
        $menu = Menu::where('part_id', $part->id)->get();
        return view('training.add-menu')->with(['menus' => $menu, 'part' => $part]);
    }
    
    public function store(Request $request, Menu $menu, Part $part){
        $input = $request['menu'];
        
        // 追加 
        $menu->name = $input["name"];
        $menu->weight = $input["weight"];
        $menu->part_id = $part->id;
        $menu->save();
        
        return redirect('/start-training');
    }
}