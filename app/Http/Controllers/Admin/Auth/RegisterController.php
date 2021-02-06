<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use RegistersUsers;

class RegisterController extends Controller
{
   protected $redirectTo = '/painel';
   
    public function __construct(){
       $this->middleware('guest');
    }

    public function index(){
       return view('admin.register');

    }

    public function register(Request $request){

        $validatedData = $request->validate([
            'name'=>['required', 'string', 'max:100'],
            'email'=>['required','string','max:100','email','unique:users,email'],
            'password'=>['required','string','min:4','confirmed'],
        ]);

        $user = User::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>Hash::make($validatedData['password']),
        ]);

        Auth::login($user);

        return redirect()->route('admin');


    }
}
