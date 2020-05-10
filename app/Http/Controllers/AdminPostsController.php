<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//added
use App\Post;
use App\User;
use App\Category;
use App\Photo;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Session;
//end

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index.blade.php is in nested directories: admin>posts       
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));  
    }
    
    public function modal(){
        return view('admin.include.modal');
        //NOT SURE
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //cant use Role::all() because it will return a collection, we need an array which is lists
        //list or pluck are the same
        $category = Category::lists('name','id')->all();
        return view('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $user = Auth::user(); //retrieving the logged in user
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
            //$input['user_id'] = $user->id; dont need this if when using $user->post()->create();
            $file->move('images', $name);
        }
        Session::flash('create_post','Your post has been created');
        // Post::create($input); dont need this if when 
        //using $user->post()->create();
        $user->post()->create($input); //use this if the other table data is has already existed. in this case. the user has been created before creating a post
        return redirect('/admin/posts'); 
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
