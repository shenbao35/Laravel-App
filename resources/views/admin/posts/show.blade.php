@extends('layouts.admin')

@section('content')

<div class="header">
  <h1 class="text-primary pb-3">
    User Post
  </h1>
</div>
<div id="authors" class="my-5">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card text-center">
          <div class="card-body">
            <img id='userPhoto' height='100' src="{{$post->user->photo ? $post->user->photo->file : 
              'https://placehold.it/400x400'}}" alt="" class="img-fluid rounded-circle w-50 mb-3" />
            <h3 class='card-title'>{{ $post->user->name }}</h3>
            <h5 class="text-muted">{{ $post->user->role->name }}</h5>
            <p class='card-text mb-5'>
              {{ $post->body }}
            </p>
            <br>
            <br>
            <br>
            <img class='mt-5' height='100' src="{{$post->photo ? $post->photo->file : 
              'https://placehold.it/400x400'}}" alt="" />
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col d-inline">
        {{-- must use get instead of head when using form open. but when using route() no need for form open --}}
        {!! Form::model($post,
        ['method'=>'GET','action'=>['AdminPostsController@edit',$post->id]]) !!}
        <div class="form-group">
          {!! Form::submit('Edit Post',['class'=>'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
      </div>

      <div class="ml-auto">
        {!! Form::model($post,
        ['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}
        <div class="form-group">
          {!! Form::submit('Delete Post',['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>

    <div class="row">
      {!! Form::open(['method'=>'GET','action'=>'AdminPostsController@index'])!!}
      <div class="form-group">
        {!! Form::submit('Back to Post',['class'=>'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection