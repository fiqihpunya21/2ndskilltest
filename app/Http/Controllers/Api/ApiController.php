<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorys;
use Exception;

class ApiController extends Controller
{
    public function index(){
        $categorys = Categorys::all();
        return response()->json($categorys);
    }

    public function show($id){
        try {
            $category = Categorys::find($id);
            if(!empty($category)){
                return response()->json($category);
            }
            else{
                return response()->json([
                    "message" => "Category not found"
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                "message" => "Token is expired."
            ], 500);
        }
        
    }

    public function store(Request $request){
        $category = Categorys::create([
            'name' => $request->name,
            'is_publish' => $request->is_publish
        ]);

        return response()->json([
            "data" => $category
        ]);
        /*
        $category = new Categorys;
        $category->name = $request->name;
        $category->is_publish = $request->is_publish;
        $category->save();
        return response()->json([
            "message" => "Category added."
        ], 201);
        */
    }

    public function update(Request $request, $id){
        if(Categorys::where('id',$id)->exists()){
            $category = Categorys::find($id);
            $category->name = is_null($request->name) ? $category->name : $request->name;
            $category->is_publish = is_null($request->is_publish) ? $category->is_publish : $request->is_publish;
            $category->save();
            return response()->json([
                "message" => "Category updated."
            ], 202);
        }
        else{
            return response()->json([
                "message" => "Category not found."
            ]);
        }
    }

    public function destroy($id){
        if(Categorys::where('id',$id)->exists()){
            $category = Categorys::find($id);
            $category->delete();

            return response()->json([
                "message" => "Category deleted."
            ], 202);
        }
        else{
            return response()->json([
                "message" => "Category not found."
            ]);
        }
    }
}
