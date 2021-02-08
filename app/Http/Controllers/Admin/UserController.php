<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can: edit-users');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $users = User::paginate(10);
        $loggedId =Auth::id();
        return view('admin.users.index',[
            'users'=>$users,
            'loggedId'=>$loggedId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
           'name' =>['required', 'string', 'max:100'],
           'email' =>['required', 'string', 'email', 'unique:users,email', 'max:100'],
           'password'=>['required', 'string', 'min:4', 'confirmed']
       ]);

       $user = User::create([
           'name'=> $validated['name'],
           'email'=>$validated['email'],
           'password'=>Hash::make($validated['password']),
       ]);

       return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        if($user){
            return view('admin.users.edit', ['user'=>$user]);
        }

        return redirect()->route('users.index');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $data = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation'
       );

        $validator = Validator::make($data, [
            'name'=>['required', 'string', 'max:100'],
            'email'=>['required', 'string', 'email', 'max:100'],
        ]);

     

        $user = User::find($id);
        
        if($user){
            
            $user->name = $data['name'];
        

            if($user->email != $data['email']){
                $foundEmail = User::where('email', $data['email'])->get();
                
                if(count($foundEmail)===0){
                    $user->email = $data['email'];
                }
                
                else{
                    $validator->errors()->add('email',__('validation.unique',['attribute'=>'email']));
                }
            }
            
             
            if(!empty($data['password'])){
                
                if(strlen($data['password']) >= 4){
                    if($data['password'] === $data['password_confirmation']){
                        $user->password = Hash::make($data['password']);
                    }
                    else{
                        $validator->errors()->add('password', __('validation.confirmed',[
                            'attribute'=>'password',
                        ]));
                    }
                }
    
                else{
                    $validator->errors()->add('password',__('validation.min.string',[
                        'attribute'=>'password',
                        'min'=>4
                    ]));
                }
            }


            if(count($validator->errors()) > 0){
               
                return redirect()->route('users.create',['user'=>$id])
                ->withErrors($validator)
                ->withInput();
              
            }
    
            $user->save();
        }

        return redirect()->route('users.index');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId = Auth::id();

        if($loggedId != $id){
            $user= User::find($id);
            $user->delete();
        }

        return redirect()->route('users.index');
    }
}
