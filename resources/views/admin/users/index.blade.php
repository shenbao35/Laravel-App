@extends('layouts.admin');
{{-- route list URI is admin/users --}}


{{-- session condition --}}
@section('content')
@if (Session::has('deleted_user'))
<div class="alert alert-danger">
  <strong>{{ session('deleted_user') }}</strong>
</div>
@endif

@if(Session::has('edited_user'))
<div class="alert alert-success">
  <strong>{{ session('edited_user') }}</strong>
</div>
@endif

@if(Session::has('added_user'))
<div class="alert alert-success">
  <strong>{{ session('added_user') }} </strong>
</div>
@endif

<h1>Users</h1>
<table class="table">
  <thead>
    <tr>
      {{-- shift + alt + down to add more --}}
      <th>Id</th>
      <th>Photo</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Status</th>
      <th>Created</th>
      <th>Updated</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    {{-- if there are users then show this --}}
    @if ($users)
    @foreach ($users as $user)
    <tr>
      <td>{{$user->id}}</td>
      {{-- if else --}}
      <td><img height="50" src="{{$user->photo ? $user->photo->file : 
      'https://placehold.it/400x400'}}" alt=""></td>
      <td><a href="{{ route('admin.users.edit',$user->id) }}
      ">{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->role != null ? $user->role->name : 'No Role'}}</td>

      {{-- if else  --}}
      <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
      <td>{{$user->created_at->diffForHumans()}}</td>
      <td>{{$user->updated_at->diffForHumans()}}</td>

      {{-- new model for the delete button --}}
      {!! Form::model($user, ['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]]) !!}
      <td>
        {!! Form::button('<i class="fa fa-trash-o fa-1x" aria-hidden="true"></i>',['class'=>'btn btn-danger',
        'type'=>'submit'])
        !!}
      </td>

      {!! Form::close() !!}
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
@endsection