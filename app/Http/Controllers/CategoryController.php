<?php

namespace App\Http\Controllers;

use App\Mail\DeleteEmail;
use App\Mail\SendEmail;
use App\Models\Categorys;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    public function index(){
        // mengambil data dari table user
    	$categorys = DB::table('categorys')->get();
 
    	// mengirim data user ke view user
    	return view('dashboard.category',['categorys' => $categorys]);
    }

    public function store(Request $request){
        
        
            // insert data ke table category
        $values = array(
            'name' => $request->category_name,
            'is_publish' => $request->is_publish
        );

        Categorys::create($values);

        Mail::to(Auth::user()->email)
        ->send(new SendEmail());


        // alihkan halaman ke halaman pegawai
        return redirect('category');
        
        
    }

    public function edit($id){
        //$user = User::find($id);
        $category = DB::table('categorys')->where('id',$id)->get();
        if(!empty($category)){
            return view('dashboard.categoryEdit',['category' => $category]);
        }
        else{
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }

    public function update(Request $request){
        // update data user
	DB::table('categorys')->where('id',$request->id)->update([
		'name' => $request->category_name,
		'is_publish' => $request->is_publish,
		'updated_at' => now(),
	]);
	// alihkan halaman ke halaman user
	return redirect('category');
    }

    public function destroy($id){
        // menghapus data user berdasarkan id yang dipilih
	DB::table('categorys')->where('id',$id)->delete();
    Mail::to(Auth::user()->email)
        ->send(new DeleteEmail());
		
	// alihkan halaman ke halaman user
	return redirect('category');
    }
}
