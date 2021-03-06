<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

use Illuminate\Support\Facades\Auth as Auth;

class HomeController extends Controller
{
    
    
    public function index(){
        $posts = Page::all();
        $posts = Page::orderBy('id', 'desc')->take(7)->get();
        $userName = null;

        if(Auth::user()){
            $userName = Auth::user()->name;
        }
       
        return view('site.home', ['posts'=>$posts, 'userName'=>$userName]);
        
       
        

    }


    public function post($id){
      
        $post = Page::find($id);
        return view('site.post',['post'=>$post]);
    }
}

