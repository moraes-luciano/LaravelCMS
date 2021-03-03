<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller
{
    
    
    public function index(){
        $posts = Page::all();
        $posts = Page::orderBy('id', 'desc')->take(7)->get();
       
        return view('site.home', ['posts'=>$posts]);

    }


    public function post($id){
      
        $post = Page::find($id);
        return view('site.post',['post'=>$post]);
    }
}

