<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperadminController extends Controller
{

    public function home(){
        $superadmins = User::where('role', 'superadmin')->get();
        $admins = User::where('role', 'admin')->get();
        $clients = User::where('role', 'client')->get();

        return view('superadmin.index', compact('superadmins', 'admins', 'clients'));
    }
    public function register(){
        return view('superadmin.create');
    }

    public function registerPost(Request $request){
        $validated = $request->validate([
            'username'=> ['required', 'unique:users',],
            'password'=>'required',
            'role'=>'required',
        ]);

        $user = New User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        if($user->save()){
            return back()->with('success', 'user added.');
        }
        else{
            return back()->with('error', 'something went wrong.');
        }
    }
}
