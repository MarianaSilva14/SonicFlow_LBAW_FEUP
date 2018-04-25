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
  			<table class="table table-striped table-hover table-bordered">
  				<tr class="info" style="color:#65768e">
    				<th></th>
            <th>Product</th>
  					<th>Item Name</th>
  					<th>Cost</th>
  					<th>Quantity</th>
            <th>Subtotal</th>
  				</tr>
  				<tr>
    				<td class="delete_cart"><i class="far fa-trash-alt fa-2x"></i></td>
            <td class="productImg"><img src="http://placehold.it/100x100" alt="..." class="img-fluid"/></td>
  					<td>Apple MacBook Pro 15''</td>
  					<td class="unitCost">€3 199,99 </td>
  					<td class="amount"><input type="number" class="form-control text-center" value="1"></td>
            <td class="totalCost">€3 199,99</td>
  				</tr>

          <tfoot>
						<tr>
							<td colspan="2"><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="3" class="hidden-xs"></td>
							<td class="hidden-xs text-center">
                <strong class="checkoutCost">3199,90€</strong>
                <a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>
              </td>
						</tr>
					</tfoot>
  			</table>
  		</div>
@endsection
