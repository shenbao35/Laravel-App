@extends('layouts.admin')

@section('content')
<h1>Edit Post</h1>


{!! Form::model($post, ['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id]]) !!}

<div class="form-group">
  <div class="form-group">
    {!! Form::label('title','Title:') !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
  </div>
  {{-- gets the data from the database and then concatenate --}}
  {!! Form::label('category_id','Category:') !!}
  {!! Form::select('category_id', array('' => 'Choose Options') + $category, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('photo_id','Photo:') !!}
  {!! Form::file('photo_id', ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('body','Description :') !!}
  {!! Form::textarea('body',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::submit('Edit Post',['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@include('include.validation')
@endsection