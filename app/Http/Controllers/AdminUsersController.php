<?php

namespace App\Http\Controllers;


//added
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Session;
//stop

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index.blade.php is in nested directories: admin>users       
        $users = User::all();
        return view('admin.users.index', compact('users'));
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
        $roles = Role::lists('name','id')->all();
        return view('admin.users.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(UserRequest $request)
    {
        // trim = remove all white spaces 
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photoId')){
            $name = time() . $file->getClientOriginalName();
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
            $file->move('images', $name);
        }
        Session::flash('added_user','A user has been added');
        User::create($input);
        return redirect('/admin/users');

        // check the incoming data
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.uses.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        Session::flash('edited_user','The user has been updated');
        $user->update($input);
        return redirect('/admin/users');


        //check the incoming data
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //these must be in order

        $user = User::findOrFail($id);
        //deleting images in the public folder
        unlink(public_path() . $user->photo->file);
        $photo = Photo::findOrFail($user->photo_id);
        $photo->delete();
        $user->delete();        
        
        Session::flash('deleted_user','A user has been deleted');
        return redirect('/admin/users');        
    }
}