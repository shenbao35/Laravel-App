@extends('layouts.admin');

{{-- route list URI is admin/users/create --}}
@section('content')
<h1>Create User</h1>
{!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store','files'=>true])!!}

{{-- null on these forms are the default value, it can be set to any default --}}
<div class="form-group">
  {!! Form::label('name','Name:') !!}
  {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('email','Email:') !!}
  {!! Form::email('email',null,['class'=>'form-control']) !!}
  {{-- change the form type for the textbox --}}
</div>
<div class="form-group">
  {{-- must remove null when using password type field --}}
  {!! Form::label('password','Password:') !!}
  {!! Form::password('password',['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('photoLabel','Photo:') !!}
  {!! Form::file('photoId', ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {{-- gets the data from the database and then concatenate --}}
  {!! Form::label('role_id','Role:') !!}
  {!! Form::select('role_id', array('' => 'Choose Options') + $roles,null ,['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('is_active','Status:') !!}
  {!! Form::select('is_active', array(0 => 'Not Active', 1 => 'Active'), 0, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@include('include.validation')

@endsection