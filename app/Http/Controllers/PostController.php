<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Events\UserRegisterPostEvent;
use Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userType = Auth::user()->user_type;
        
        $posts = Post::join('users', 'users.id','=', 'posts.createBy')
         ->where(function ($query) use ($userType,$request) {
            if($userType == 'client'){
                $query->orWhere('posts.title','LIKE','%'.$request->search.'%')->orWhere('posts.assignTo','LIKE','%'.$request->search.'%');
            }else{
                $query->Where('posts.assignTo','designer');
                if($request->search){
                    $query->orWhere('users.name','LIKE','%'.$request->search.'%')->orWhere('posts.title','LIKE','%'.$request->search.'%');
                }
            }
        })->get();
       
        return view('posts.index')->with(array('posts'=>$posts));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $files = $request->file('image');

        $imageArray = array();
        if(isset($files)){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move(public_path('post_images'),$name);
                $imageArray[]=$name;
            }
        }
        $post = new Post();
        $post->title = $request->name;        
        $post->description = $request->description;        
        $post->images = implode("|",$imageArray);        
        $post->date = $request->date;             
        $post->createBy = $userId;             
        $post->assignTo = $request->assignTo;             
        $post->save();     

        if(!is_null($post)) { 
            return redirect('/posts')->with("success", "Successfully added post!");
        }else {
            return back()->with("failed", "Registration failed. Try again.");
        }
       
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
        $posts = Post::where('id',$id)->first(); 
        return view('posts.edit')->with(array('posts'=>$posts)); 
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
        $posts = Post::where('id',$id)->first(); 

        $file = $request->file('image');
        if(isset($file)){
            $imageName = time().'.'.$file->extension();  
        
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = $posts->image;
        }

        $posts = Post::where('id',$id)->update(['name'=>$request->name,'description'=>$request->description,'image'=>$imageName,'date'=>$request->date]); 
        if(!is_null($posts)) { 
            return redirect('/posts')->with("success", "Successfully updated!");
        }else {
            return back()->with("failed", "Registration failed. Try again.");
        }
    }


    public function share(Request $request){
        $posts = Post::where('id',$request->postid)->update(['accessUser'=>$request->users]); 
        if(!is_null($posts)) { 
            return back()->with("success", "Successfully updated!");
        }else {
            return back()->with("failed", "Registration failed. Try again.");
        }
    }

        
}
