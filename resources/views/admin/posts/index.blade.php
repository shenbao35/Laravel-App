@extends('layouts.admin')

@section('content')
{{-- 
@if (Session::has('create_post'))
<div class="alert alert-success">
  <strong>{{ session('create_post') }}</strong>
</div>
@endif --}}

<h1>Posts</h1>
<table class="table">
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Category</th>
      <th>Title</th>
      <th>Created</th>
      <th>Updated</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <td>{{$post->id}}</td>

      <td><a href="#">{{$post->user->name }}</a></td>

      <td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
      <td>{{$post->title}}</td>
      <td>{{$post->created_at->diffForHumans()}}</td>
      <td>{{$post->updated_at->diffForHumans()}}</td>
    </tr>
    @endforeach
  </tbody>
</table>


{{-- modal part --}}
@include('include.modal')


@endsection