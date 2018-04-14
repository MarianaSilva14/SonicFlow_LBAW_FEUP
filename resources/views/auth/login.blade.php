@extends('layouts.app')

@section('title', 'Login')

@section('head')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="card card-container">
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
      <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
      <p id="profile-name" class="profile-name-card"></p>
      <form method="post" action="{{ route('login') }}" class="form-signin">
        {{ csrf_field() }}
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" autofocus>
        @if ($errors->has('username'))
            <span class="error">
              {{ $errors->first('username') }}
            </span>
        @endif
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif
        <div id="remember" class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        <a href="{{ route('register') }}" class="btn btn-lg btn-primary btn-block btn-register" >Register</a>
      </form>
      <a href="#" class="forgot-password">
          Forgot the password?
      </a>
  </div>
</div>
@endsection

<!-- @extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form>
@endsection -->
