@extends('layouts.app')

@section('title', 'About Us')

@section('head')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
<link rel="stylesheet" href="{{ asset('css/aboutpage.css') }}">
<script src="js/common.js" defer></script>
@endsection

@section('content')
<nav class="breadcrumb">
  <a class="breadcrumb-item" href="homepage.html">Homepage</a>
  <span class="breadcrumb-item active">About us</span>
</nav>
<h1 class="header-title">About Sonic Flow</h1>
<h3> <span>OUR STORY </span></h3>
<p class="text_about"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
  the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
  it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
  typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
  containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
  versions of Lorem Ipsum.
</p>
<h3><span>OUR PURPOSE</span></h3>
<p style="text-align:center"><b>To provide the best technological products</b></p>
<br> <br>
@endsection
