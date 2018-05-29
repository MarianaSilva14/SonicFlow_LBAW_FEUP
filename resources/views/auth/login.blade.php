@extends('layouts.app')

@section('title', 'Login')

@section('head')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="card card-container">
      <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="Profile Image"/>
      <p id="profile-name" class="profile-name-card"></p>
      <form method="post" action="{{ route('login') }}" class="form-signin">
        {{ csrf_field() }}
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" autofocus>
        @if ($errors->has('username'))
            <span class="text-danger">
              {{ $errors->first('username') }}
            </span>
        @endif
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
        @if ($errors->has('password'))
            <span class="text-danger">
                {{ $errors->first('password') }}
            </span>
        @endif
        <div id="remember" class="checkbox">
            <label for="Remember me">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        <a href="{{ route('register') }}" class="btn btn-lg btn-primary btn-block btn-register" >Register</a>
      </form>
      <a href="{{ route('recoverPasswordConfirmation') }}" class="forgot-password">
          Forgot the password?
      </a>
      <div class="g-signin2" data-onsuccess="onSignIn"></div>
  </div>
</div>
@endsection
