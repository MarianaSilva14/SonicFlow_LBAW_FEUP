@extends('layouts.app')

@section('title', 'Reset Password')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="card card-container">
            @if( $error )
                There was an error with the password recovery, please contact us.
            @else
                An email was sent to you, please check your inbox.
            @endif
        </div>
    </div>
@endsection
