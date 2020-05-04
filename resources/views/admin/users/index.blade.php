@extends('layouts.admin');

{{-- route list URI is admin/users --}}
@section('content')
{{-- <ul>
  @foreach ($users->name as $user)
  <li>{{ $user }}</li>
@endforeach
</ul> --}}
<h1>Users</h1>
<table class="table">
  <thead>
    <tr>
      {{-- shift + alt + down to add more --}}
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Status</th>
      <th>Created</th>
      <th>Updated</th>
    </tr>
  </thead>
  <tbody>
    {{-- if there are users then show this --}}
    @if ($users)
    @foreach ($users as $user)
    <tr>
      <td></a>{{$user->id}}</td>
      <td><a href="{{ route('admin.users.edit',$user->id) }}
      ">{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->role->name}}</td>

      {{-- if else  --}}
      <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
      <td>{{$user->created_at->diffForHumans()}}</td>
      <td>{{$user->updated_at->diffForHumans()}}</td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
@endsection