@extends('layouts.app')

@section('title', 'About Us')

@section('head')
<link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Contacts'])
<h1 class="header-title"> Contact Us</h1>
<h5 class="sub-title">We'd love to hear from you!</h5>
<br>
<div class="col-sm-12" id="parent">
  <div class="row">
    <div id="formContainer" class="col-sm-6">
      <form id="contactForm">
        <div  class="form-group">
          <input type="text" class="form-control" id="name" name="nm" placeholder="Name" required autofocus="">
        </div>
        <div class="form-group form_left">
          <input type="email" class="form-control" id="email" name="em" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Mobile No." required="">
        </div>
        <div class="form-group">
          <textarea class="form-control textarea-contact" rows="5" id="comment" name="FB" placeholder="Type Your Message/Feedback here..." required></textarea>
          <br>
          <button class="btn btn-default btn-send"> <span class="glyphicon glyphicon-send"></span> Submit </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container second-portion">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-lg-4">
      <div class="box">
        <div class="icon">
          <div class="image"><i class="fas fa-envelope"></i></div>
          <div class="info">
            <br>
            <h3 class="title">MAIL & WEBSITE</h3>
            <p>
              <i class="fas fa-envelope"></i> &nbsp gondhiyahardik6610@gmail.com
              <br>
              <br>
              <i class="fas fa-globe"></i> &nbsp www.hardikgondhiya.com
            </p>
          </div>
        </div>
        <div class="space"></div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-4">
      <div class="box">
        <div class="icon">
          <div class="image"><i class="fas fa-mobile" aria-hidden="true"></i></div>
          <div class="info">
            <br>
            <h3 class="title">CONTACT</h3>
            <p>
              <i class="fas fa-mobile" aria-hidden="true"></i> &nbsp (+91)-9624XXXXX
              <br>
              <br>
              <i class="fas fa-mobile" aria-hidden="true"></i> &nbsp  (+91)-7567065254
            </p>
          </div>
        </div>
        <div class="space"></div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-4">
      <div class="box">
        <div class="icon">
          <div class="image"><i class="fas fa-map-marker" aria-hidden="true"></i></div>
          <div class="info">
            <br>
            <h3 class="title">ADDRESS</h3>
            <p>
              <i class="fas fa-map-marker" aria-hidden="true"></i> &nbsp 15/3 Junction Plot
              "Shree Krishna Krupa", Rajkot - 360001.
            </p>
          </div>
        </div>
        <div class="space"></div>
      </div>
    </div>
  </div>
</div>
  @endsection
