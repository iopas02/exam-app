<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginPost(Request $request){
        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required'],
        ]);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        else{
            return back()->with('error', 'Wrong credentials.');
        }
        
    }

    public function home(){
        if(Auth::user()->role == 'superadmin'){
            return redirect()->route('superadmin.home');
        }
        elseif(Auth::user()->role == 'admin'){
            return redirect()->route('admin.index');
        }
        elseif(Auth::user()->role == 'client'){
            return redirect()->route('client.home');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Logout Successful');
    }
}
