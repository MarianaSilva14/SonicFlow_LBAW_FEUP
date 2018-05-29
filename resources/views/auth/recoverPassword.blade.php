@extends('layouts.app')

@section('title', 'Reset Password')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="card card-container">

            <form action="{{route('recoverPassword')}}" method="post">
                {{ csrf_field() }}

                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="username" placeholder="Username" pattern="[a-zA-Z0-9]+" required>
                <button type="submit" class="btn btn-info">Recover</button>
            </form>

        </div>
    </div>
@endsection
