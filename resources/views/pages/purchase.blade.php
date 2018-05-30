@extends('layouts.app')

@section('title', 'Checkout')

@section('head')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkoutpage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Checkout'])
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Your cart</span>
      <span class="badge badge-secondary badge-pill">{{count($products)}}</span>
    </h4>
    <ul class="list-group mb-3">
      @for ($i = 0; $i < count($products); $i++)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{$products[$i]->title}}</h6>
            <small class="text-muted">{{$values[$i]}} Unit(s)</small>
          </div>
          @if($products[$i]->discountprice != "")
            <span class="text-muted">{{$products[$i]->discountprice}}€</span>
          @else
            <span class="text-muted">{{$products[$i]->price}}€</span>
          @endif
        </li>
      @endfor
      <li class="list-group-item d-flex justify-content-between">
        <span>Total (Euro)</span>
        <strong id="totalPriceToPay">
          <?php $total = 0; ?>

          <?php ; for($i=0; $i < count($products); $i++) {
              if($products[$i]->discountprice != "")
                  $total += $products[$i]->discountprice*$values[$i];
              else
                  $total += $products[$i]->price*$values[$i];
            } echo $total?></strong><strong>€

        </strong>
        <input hidden type="number" id="totalPriceToPayBeforeDiscount" value="<?php echo $total?>">
        You get <?php echo intval($total)?> LP.
      </li>
    </ul>

    <form class="card p-2">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Promo Code">
        <div class="input-group-append">
          <button type="submit" class="btn btn-secondary">Redeem</button>
        </div>
      </div>
    </form>

  </div>
  <div class="col-md-8 order-md-1" >

    <h4 class="mb-3">Payment</h4>

    <hr class="mb-4">

    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="same-address">
      <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
    </div>
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="save-info">
      <label class="custom-control-label" for="save-info">Save this information for next time</label>
    </div>
    <hr class="mb-4">
    <form class="" action="{{route('purchase')}}" method="post">
      {{ csrf_field() }}

      <div class="d-block my-3">
        <div class="custom-control custom-radio">
          <input id="credit" name="paymentMethod" value="Credit" type="radio" class="custom-control-input" checked required>
          <label class="custom-control-label" for="credit">Credit card</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="debit" name="paymentMethod" value="Debit" type="radio" class="custom-control-input" required>
          <label class="custom-control-label" for="debit">Debit card</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="paypal" name="paymentMethod" value="Paypal" type="radio" class="custom-control-input" required>
          <label class="custom-control-label" for="paypal">Paypal</label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cc-name">Name on card</label>
          <input type="text" class="form-control" id="cc-name" placeholder="" required>
          <small class="text-muted">Full name as displayed on card</small>
          <div class="invalid-feedback">
            Name on card is required
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="cc-number">Credit card number</label>
          <input type="text" class="form-control" id="cc-number" placeholder="" pattern="^([0-9]{16})$" required><small class="text-muted"> Sixteen numbers are required </small>
          <div class="invalid-feedback">
            Credit card number is required
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="cc-expiration">Expiration</label>
          <input type="text" class="form-control" id="cc-expiration" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$" required>
          <div class="invalid-feedback">
            Expiration date required
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <label for="cc-expiration">CVV</label>
          <input type="text" class="form-control" id="cc-cvv" placeholder="Three numbers" pattern="[1-9]{3}" required>
          <div class="invalid-feedback">
            Security code required
          </div>
        </div>
      </div>

      <div class="input-group">

        <input id="loyaltyPointsInput" name="loyaltyPoints" type="number" min="0" max="{{  min([$customer->loyaltypoints, intval($total)*100]) }}" onchange="updatePriceLoyaltyPoints(event)" step="100" class="form-control" placeholder="For Each 100 LP you get 1 € discount." required>
      </div>

      <hr class="mb-4">

      <button class="btn btn-primary btn-lg btn-block" type="submit">Purchase</button>

    </form>
  </div>
</div>
@endsection
