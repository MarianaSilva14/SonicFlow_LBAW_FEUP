@extends('layouts.app')

@section('title', 'About Us')

@section('head')
<link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
<link rel="stylesheet" href="{{ asset('css/aboutpage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'About Us'])
<h1 class="header-title">About Sonic Flow</h1>
<h3> <span>OUR BRAND </span></h3>
<p class="text_about" style="text-align:center"> More than presenting variety and innovation, Sonic Flow has been
  offering the best prices for more than a decade.
  We are betting on a strong promotional component, precisely to meet the expectations of the consumer, for whom the
  act of buying is increasingly weighted. In fact, the Sonic Flow customer expects a strong and distinctive
  communication that will make him continue to choose the brand.
</p>
<h3><span>OUR PURPOSE</span></h3>
<p style="text-align:center"><b>To provide the best technological products</b></p>
<br> <br>
@endsection
