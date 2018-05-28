@extends('layouts.app')

@section('title', 'Shopping Cart\'s')

@section('head')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/shoppingCart.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Shopping Cart'])

  <!-- Page content -->

    		<div class="panel panel-primary">
   			<div class="panel-heading"><h4 style="padding-bottom: 19px">Shopping Cart</h4></div>
  			<table id="shoppingCartTable" class="table table-striped table-hover table-bordered">
  				<tr class="info" style="color:#65768e">
    				<th></th>
            <th>Product</th>
  					<th>Item Name</th>
  					<th>Cost</th>
  					<th>Quantity</th>
            <th>Subtotal</th>
  				</tr>
          @if(count($products)==0)
            <td colspan="6">No products currently on shopping cart</td>
          @endif
          @for ($i = 0; $i < count($products); $i++)
            <tr>
              <td class="delete_cart removeSingle" data-id="{{$products[$i]->sku}}"><i class="far fa-trash-alt fa-2x"></i></td>
              <td class="productImg"><img src="{{Storage::url($products[$i]->getImages()[0])}}" alt="Product Image" class="img-fluid"/></td>
              <td>{{$products[$i]->title}}</td>
              <td class="unitCost">
                  @if($products[$i]->discountprice != "")
                      {{$products[$i]->discountprice}}
                  @else
                      {{$products[$i]->price}}
                  @endif
                  €</td>
              <td class="amount"><input type="number" class="form-control text-center" min=1 max={{$products[$i]->stock}} value="{{$values[$i]}}"></td>
              <td class="totalCost">
                  @if($products[$i]->discountprice != "")
                      {{$values[$i]*$products[$i]->discountprice}}
                  @else
                      {{$values[$i]*$products[$i]->price}}
                  @endif
                  €
              </td>
            </tr>
          @endfor
          <tfoot>
						<tr>
							<td colspan="2">
                <a href="{{route('homepage')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <a href="" class="btn btn-success btn-block removeAll"><i class="far fa-trash-alt"></i> Remove All</a>
                <a href="" class="btn btn-success btn-block"><i class="fas fa-heart"></i> Add to Wishlist</a>
              </td>
							<td colspan="3" class="hidden-xs"></td>
							<td class="hidden-xs text-center">
                <strong class="checkoutCost">
                  <?php $total=0; for($i=0; $i < count($products); $i++) {
                      if($products[$i]->discountprice != "")
                          $total += $products[$i]->discountprice*$values[$i];
                      else
                          $total += $products[$i]->price*$values[$i];
                    } echo $total?>€
                </strong>
                <a href="{{route('checkout')}}" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>
              </td>
						</tr>
					</tfoot>
  			</table>
  		</div>
@endsection
