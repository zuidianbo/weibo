@extends('layout.default')
@section('title', '所有用户')

@section('content')
   <div class="offset-md-2 col-md-8">
      <h2 class="mb-4 text-center">所有用户</h2>
      <div class="list-group list-group-flush">
         @foreach ($usershhh as $user)
            @include('user._user')
         @endforeach
      </div>

{{--分页--}}
      <div class="mt-3">
         {!! $usershhh->render() !!}
      </div>

   </div>
@stop