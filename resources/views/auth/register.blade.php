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

      <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" autofocus required>
      @if ($errors->has('username'))
        <span class="text-danger">
      {{ $errors->first('username') }}
      </span>
      @endif
      <input type="text" id="inputFirstName" name="firstname" class="form-control" placeholder="First Name"  required>
      @if ($errors->has('firstname'))
        <span class="text-danger">
      {{ $errors->first('firstname') }}
      </span>
      @endif
      <input type="text" id="inputLastName" name="lastname" class="form-control" placeholder="Last Name" required>
      @if ($errors->has('lastname'))
        <span class="text-danger">
      {{ $errors->first('lastname') }}
      </span>
      @endif
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>
      @if ($errors->has('email'))
        <span class="text-danger">
      {{ $errors->first('email') }}
      </span>
      @endif
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      @if ($errors->has('password'))
        <span class="text-danger">
      {{ $errors->first('password') }}
      </span>
      @endif
      <input type="password" id="inputConfirmPassword" name='password_confirmation' class="form-control" placeholder="Confirm Password" required>

      <textarea class="form-control" style="resize:none;" name="address" placeholder="Address" rows="2"></textarea>
      @if ($errors->has('address'))
        <span class="error">
      {{ $errors->first('address') }}
      </span>
      @endif
      <br>

      <button class="btn btn-lg btn-primary btn-block btn-register" >Register</button>
    </form>
  </div>
</div>
@endsection
