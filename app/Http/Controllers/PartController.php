<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Menu;

class PartController extends Controller
{
    public function storePart(Request $request){
        $input = $request['part'];
        // 追加
        $part = new Part();
        $part->fill($input)->save();
        $partId = $part->id;
        
        return $partId;
    }
    
    public function deletePart(Request $request) {
        $id = $request["id"];
        //dd($input);
        $part = Part::find($id);
        $menus = Menu::where("part_id", $id)->get();
        
        $part->delete();
        foreach($menus as $menu) {
            $menu->delete();
        }
        
        return redirect('/training/index');
    }
}
