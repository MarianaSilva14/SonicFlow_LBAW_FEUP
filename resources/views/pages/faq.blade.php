@extends('layouts.app')

@section('title', 'FAQ\'s')

@section('head')
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'FAQ\'s'])
<div class="row">
  <div class="col-md-4" id="topics_help">
    <ul class="list-group help-group">
      <div class="faq-list list-group nav nav-tabs">
        <a href="#tab1" class="list-group-item active" role="tab" data-toggle="tab">Frequently Asked Questions</a>
        <a href="#tab2" class="list-group-item" role="tab" data-toggle="tab"><i class="mdi mdi-account"></i> My profile</a>
        <a href="#tab3" class="list-group-item" role="tab" data-toggle="tab"><i class="mdi mdi-account-settings"></i> My account</a>
        <a href="#tab4" class="list-group-item" role="tab" data-toggle="tab"><i class="mdi mdi-star"></i> My favorites</a>
        <a href="#tab5" class="list-group-item" role="tab" data-toggle="tab"><i class="mdi mdi-cart"></i> Checkout</a>
        <a href="#tab6" class="list-group-item" role="tab" data-toggle="tab"><i class="mdi mdi-heart"></i> Compare Products</a>
        <a href="#tab7" class="list-group-item" role="tab" data-toggle="tab"><i class="mdi mdi-check"></i> Configurator</a>
      </div>
    </ul>
  </div>
  <div class="col-md-8">
    <div class="tab-content panels-faq">
      <div class="tab-pane active" id="tab1">
        <div class="panel-group" id="help-accordion-1">
          <div class="panel panel-default panel-help">
            <a href="#opret-produkt" data-toggle="collapse" data-parent="#help-accordion-1">
              <div class="panel-heading">
                <h2>How do I edit my profile?</h2>
              </div>
            </a>
            <div id="opret-produkt" class="collapse in">
              <div class="panel-body">
                <p>To edit your profile, you should click on the "Profile Picture" icon in the navigation bar, and you can edit your information, by clicking "Edit" and then "Save Changes".</p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panel-help">
            <a href="#rediger-produkt" data-toggle="collapse">
              <div class="panel-heading">
                <h2>How do I upload a new profile picture?</h2>
              </div>
            </a>
            <div id="rediger-produkt" class="collapse">
              <div class="panel-body">
                <p>To edit your profile photo you should click on the "Profile Picture" icon in the navigation bar, then click "Edit" and in the "Profile Picture" field choose a photo. Then click on "Save Changes".</p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panel-help">
            <a href="#opret-kampagne" data-toggle="collapse" data-parent="#help-accordion-1">
              <div class="panel-heading">
                <h2>How do I change my password?</h2>
              </div>
            </a>
            <div id="opret-kampagne" class="collapse">
              <div class="panel-body">
                <p>To change your password click on the "Profile Picture" icon in the navigation bar, then click "Edit" and in the "password" field choose a new password. Then click on "Save Changes".</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab2">
        <div class="panel-group" id="help-accordion-2">
          <div class="panel panel-default panel-help">
            <a href="#help-three" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I edit my profile?</h2>
              </div>
            </a>
            <div id="help-three" class="collapse in">
              <div class="panel-body">
                <p>To edit your profile, you should click on the "Profile Picture" icon in the navigation bar, and you can edit your information, by clicking "Edit" and then "Save Changes".</p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panel-help">
            <a href="#help-three2" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I upload a new profile picture?</h2>
              </div>
            </a>
            <div id="help-three2" class="collapse in">
              <div class="panel-body">
                <p>To edit your profile photo you should click on the "Profile Picture" icon in the navigation bar, then click "Edit" and in the "Profile Picture" field choose a photo. Then click on "Save Changes".</p>
              </div>
            </div>
          </div>
          <div class="panel panel-default panel-help">
            <a href="#help-three3" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I change my password?</h2>
              </div>
            </a>
            <div id="help-three3" class="collapse in">
              <div class="panel-body">
                <p>To change your password click on the "Profile Picture" icon in the navigation bar, then click "Edit" and in the "password" field choose a new password. Then click on "Save Changes".</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab4">
        <div class="panel-group" id="help-accordion-2">
          <div class="panel panel-default panel-help">
            <a href="#help-three5" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I add products to the wish list?</h2>
              </div>
            </a>
            <div id="help-three5" class="collapse in">
              <div class="panel-body">
                <p>To add products to the wish list, you must click the heart-shaped button on the respective product.</div>
          </div>
        </div>
      </div>
      </div>
      <div class="tab-pane" id="tab5">
        <div class="panel-group" id="help-accordion-2">
          <div class="panel panel-default panel-help">
            <a href="#help-three4" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I checkout products?</h2>
              </div>
            </a>
            <div id="help-three4" class="collapse in">
              <div class="panel-body">
                <p>To buy products, you have to click the "Add to Cart" button. Then click on the cart in the navigation bar and click on the "Checkout" button.</div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab6">
        <div class="panel-group" id="help-accordion-2">
          <div class="panel panel-default panel-help">
            <a href="#help-three6" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I compare products?</h2>
              </div>
            </a>
            <div id="help-three6" class="collapse in">
              <div class="panel-body">
                <p>To compare products, you have to click the "Compare" button.</div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab7">
        <div class="panel-group" id="help-accordion-2">
          <div class="panel panel-default panel-help">
            <a href="#help-three7" data-toggle="collapse" data-parent="#help-accordion-2">
              <div class="panel-heading">
                <h2>How do I use Configurator?</h2>
              </div>
            </a>
            <div id="help-three7" class="collapse in">
              <div class="panel-body">
                <p>To buy products, you have to click the "Add to Cart" button. Then click on the cart in the navigation bar and click on the "Checkout" button.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
