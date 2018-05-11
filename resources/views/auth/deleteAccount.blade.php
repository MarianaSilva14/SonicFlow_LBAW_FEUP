@extends('layouts.app')

@section('title', 'Delete Account')

@section('head')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="card card-container">
    @if(Auth::user())
      Please confirm your password to delete account
      <form class="" action="{{route('profile',Auth::user()->username)}}/delete" method="post">
        {{ csrf_field() }}
        <input type="password" name="password" value="">
        <br>
        @if ($error1 != null)
          <span class="text-danger">
            {{ $error1 }}
          </span>
        @endif
        @if ($errors->has('password'))
          <span class="text-danger">
            {{ $errors->first('password') }}
          </span>
        @endif
        <br>
        <button type="submit" class="btn btn-danger">DELETE</button>
      </form>
    @else
      You have been loged out please <span><a href="{{route('login')}}">login</a></span> again to proceed.
    @endif
  </div>
</div>
@endsection
