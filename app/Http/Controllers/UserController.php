<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Auth;
use App\Events\UserRegisterEvent;

class UserController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user = User::firstOrNew(['id' =>  $user->id]); 
        
        $userMobile = User::firstOrNew(['mobile' =>  $request->mobile]); 
        
        // if($userMobile->exists) { 
        //     return back()->with("success", "Mobile number already exist!");
        // }

        $file = $request->file('profile_image');
        $imageName = $user->profile_image;
        if(isset($file)){
            $imageName = time().'.'.$file->extension();  
     
            $request->profile_image->move(public_path('images'), $imageName);
        }
        $user->name = $request->name;        
        $user->email = $request->email;        
        $user->mobile = $request->mobile;        
        $user->profile_image = $imageName;        
        $user->user_type = $request->user_type;               
        $user->save(); 

        event(new UserRegisterEvent($user));

        if(!is_null($user)) { 
            return redirect('/home')->with("success", "Successfully register!");
        }else {
            return back()->with("failed", "Registration failed. Try again.");
        }
       
    }

}
