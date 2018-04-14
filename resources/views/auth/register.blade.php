@extends('layouts.app')

@section('title', 'Register')

@section('head')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="card card-container">
    <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
    <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
    <p id="profile-name" class="profile-name-card"></p>
    <form method="post" action="{{route('register')}}" class="form-signin">
      {{ csrf_field() }}
      <span id="reauth-email" class="reauth-email"></span>

      <input type="text" id="inputUsername" class="form-control" placeholder="Username" autofocus>
      <input type="text" id="inputFirstName" class="form-control" placeholder="First Name" >
      <input type="text" id="inputLastName" class="form-control" placeholder="Last Name" >
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" >
      <input type="password" id="inputPassword" class="form-control" placeholder="Password">
      <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password">
      <textarea class="form-control" style="resize:none;" placeholder="Address" rows="2"></textarea>
      <br>

      <button class="btn btn-lg btn-primary btn-block btn-register" >Register</button>
    </form>
  </div>
</div>
@endsection
<!-- @extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
{{ csrf_field() }}

<label for="name">Name</label>
<input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
@if ($errors->has('name'))
<span class="error">
{{ $errors->first('name') }}
</span>
@endif

<label for="email">E-Mail Address</label>
<input id="email" type="email" name="email" value="{{ old('email') }}" required>
@if ($errors->has('email'))
<span class="error">
{{ $errors->first('email') }}
</span>
@endif

<label for="password">Password</label>
<input id="password" type="password" name="password" required>
@if ($errors->has('password'))
<span class="error">
{{ $errors->first('password') }}
</span>
@endif

<label for="password-confirm">Confirm Password</label>
<input id="password-confirm" type="password" name="password_confirmation" required>

<button type="submit">
Register
</button>
<a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>
@endsection -->
