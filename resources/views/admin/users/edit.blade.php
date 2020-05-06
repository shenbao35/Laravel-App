@extends('layouts.admin');

{{-- route list URI is admin/users/create --}}
@section('content')
<h1>Edit User</h1>
<div class="row">
  <div class="col-sm-3">
    {{-- can substitute a local picture for a nonexistent picture --}}
    <img src="{{ $user->photo ? $user->photo->file : 'https://placehold.it/400x400'}}" alt=""
      class="img-responsive img-rounded">
  </div>
  <div class="col-sm-9">
    {!! Form::model($user, ['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}

    {{-- null on these forms are the default value, it can be set --}}
    <div class="form-group">
      {!! Form::label('name','Name:') !!}
      {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email','Email:') !!}
      {!! Form::email('email',null,['class'=>'form-control']) !!}
      {{-- change the from type for the textbox --}}
    </div>
    <div class="form-group">
      {{-- must remove null when using password type field --}}
      {!! Form::label('password','Password:') !!}
      {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('photo_id','Photo:') !!}
      {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {{-- gets the data from the database and then concatenate --}}
      {!! Form::label('role_id','Role:') !!}
      {!! Form::select('role_id', array('' => 'Choose Options') + $roles,null ,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('is_active','Status:') !!}
      {!! Form::select('is_active', array(0 => 'Not Active', 1 => 'Active'), null, ['class'=>'form-control']) !!}
      {{-- put null to let laravel decide the value o fthe select form --}}
    </div>
    <div class="form-group">
      {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>
<div class="row">
  @include('include.validation')
</div>

@endsection