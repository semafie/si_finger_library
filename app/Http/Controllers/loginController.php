<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function loginakun(Request $request) {

        // dd($request->all());
        
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email', 'password'); // Hanya ambil email dan password
    
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
            
            
            if (Auth::user()->role == 'admin') {

                return redirect()->intended('admin/dashboard')->with(Session::flash('success_message', true));
            }


        } else {
            return redirect()->back()->with('error')->with(Session::flash('gagal_login', true));
            // Autentikasi gagal
            // Lakukan sesuatu
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url('login'));
    }
}
