@extends('layouts.app')

@section('title', 'Reset Password')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="form-group">
        <div class="card card-container">

            <form action="{{route('recoverPassword')}}" method="post">
                {{ csrf_field() }}
                <input type="email" name="email" placeholder="Email" class="recover form-control" required>
                <input type="text" name="username" placeholder="Username" class="recover form-control" pattern="[a-zA-Z0-9]+" required>
                <button type="submit" class="btn btn-primary" id="recover" >Recover</button>
            </form>
        </div>
    </div>
@endsection
