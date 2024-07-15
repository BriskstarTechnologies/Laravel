<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
class ItemController extends Controller
{
    public function index(){
        return Items::all();
    }

    public function update(Request $request){
        $id = $request->id;
        
        $data = Items::find($id);
        $data->checked = $data->checked == 1 ? 0 : 1;
        $data->save();
        return response()->json($data, 200);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $item = Items::create($request->all());
        return response()->json($item, 201);
    }
}
