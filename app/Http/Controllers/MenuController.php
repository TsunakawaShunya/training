<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Part;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function showIndex() {
        $parts = Part::where('user_id', Auth::id())->get();
        return view('training.index')->with(['parts' => $parts]);
    }
    
    public function showMenu(Part $part) {
        $parts = Part::where('user_id', Auth::id())->get();
        $menu = Menu::where('part_id', $part->id)->get();

        return view('training.menu')->with(['menus' => $menu, 'parts' => $parts, 'selectedPart' => $part]);
    }
    
    public function storeMenu(Request $request){
        $input = $request['menu'];

        // 追加
        $menus = new Menu();
        $menus->fill($input)->save();

        return redirect('/training/menu/' . $input["part_id"]);
    }
    
    public function storePart(Request $request){
        $input = $request['part'];
        // 追加
        $part = new Part();
        $part->fill($input)->save();
        $partId = $part->id;
        
        return redirect('/training/index');
    }

}