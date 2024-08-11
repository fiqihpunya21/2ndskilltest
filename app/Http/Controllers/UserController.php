<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        // mengambil data dari table user
    	$users = DB::table('users')->get();
 
    	// mengirim data user ke view user
    	return view('dashboard.user',['users' => $users]);
    }

    public function store(Request $request){
        $user = DB::table('users')->where('email',$request->email)->count();
        if($user > 0){
            return response()->json([
                'message' => 'Email already exist.'
            ]);
        }
        else{
            // insert data ke table user
        $values = array(
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        );

        User::create($values);

        // alihkan halaman ke halaman pegawai
        return redirect('user');
        }
        
    }

    public function edit($id){
        //$user = User::find($id);
        $user = DB::table('users')->where('id',$id)->get();
        if(!empty($user)){
            return view('dashboard.userEdit',['user' => $user]);
        }
        else{
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function update(Request $request){
        // update data user
	DB::table('users')->where('id',$request->id)->update([
		'name' => $request->name,
		'email' => $request->email,
		'updated_at' => now(),
	]);
	// alihkan halaman ke halaman user
	return redirect('user');
    }

    public function destroy($id){
        // menghapus data user berdasarkan id yang dipilih
	DB::table('users')->where('id',$id)->delete();
		
	// alihkan halaman ke halaman user
	return redirect('user');
    }
}
