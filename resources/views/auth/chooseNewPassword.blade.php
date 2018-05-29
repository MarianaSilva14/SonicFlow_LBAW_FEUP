@extends('layouts.app')

@section('title', 'Reset Password')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="card card-container">

            <form action="{{route('newPassword')}}" method="post">
                {{ csrf_field() }}

                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <input type="hidden" name="token" value="{{ $token }}">
                <button type="submit" class="btn btn-info">Change Password</button>
            </form>

        </div>
    </div>
@endsection
