<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
   
    public function __construct(){
       $this->middleware('guest')->except('logout');
   }
    public function index(){

        return view('admin.login');
    }

    public function authenticate(Request $request){

        $validateData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:100'],
            'password'=>['required', 'string', 'min:4'],
        ]);
        
        $remember = $request->input('remember',false);

        if(Auth::attempt($validateData,$remember)){
            return redirect()->route('admin');
        }
        else{
            return redirect()->route('login');
        }

        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
