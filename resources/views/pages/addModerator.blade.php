@extends('layouts.add_items')

@section('title', 'New Moderator')

@section('head')
    <!-- <link rel="stylesheet" href="{{ asset('css/productpage.css') }}"> -->
@endsection

@section('content')
    <form method="post" action="{{route('moderator_create_post')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label for="pictures">Picture</label>
        <input type="file" id="pictures" name="picture"  class="form-control">

        <label for="username">Username</label>
        <input class="form-control" id="username" name="username" placeholder="Moderator Username">

        <label for="password">Password</label>
        <input class="form-control" id="password" type="password" name="password" placeholder="Moderator Password" >

        <label for="confirm_password">Confirm Password</label>
        <input class="form-control" id="confirm_password" type="password" name="password_confirm" placeholder="Confirm Password" >

        <label for="email">Email</label>
        <input class="form-control" id="email" name="email" placeholder="Moderator Email" >

        <br>
        <button class="btn" style="vertical-align:middle">Add Moderator</button>
    </form>
@endsection