@extends('layouts.app')

@section('title', '404')

@section('head')
<link rel="stylesheet" href="{{ asset('css/errorpage.css') }}">
@endsection

@section('content')
			<div class="container-fluid" id="body-container-fluid">
				<div class="container">
					<!---- for body container ---->


						<div class="jumbotron">
						<h1 class="display-1">4<i class="fa  fa-spin fa-cog fa-3x"></i> 4</h1>
						<h1 class="display-3">ERROR</h1>
            <br> <br>
						<p class="lower-case">Webpage not found! Please try to refresh!</p>
						<p class="lower-case">Maybe the page is under maintenance</p>
            <br> <br> <br> <br> <br><br> <br> <br> <br> <br>
            <p class="lower-case"> <a class="home-page" href={{route('homepage')}}> GO BACK TO OUR HOMEPAGE </a> </p>
						</div>

				</div>
			</div>
  @endsection
