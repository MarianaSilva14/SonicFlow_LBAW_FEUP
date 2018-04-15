@extends('layouts.admin')

@section('title','Moderator')

@section('tab1Name','Flagged Comments')
@section('tab1')
<table class="table table-hover table-bordered">
  <tr class="info" style="color:#65768e">
    <th>Picture</th>
    <th>Username</th>
    <th>Comment</th>
    <th>Number Offenses</th>
    <th>Ignore</th>
    <th>Add offense</th>
    <th>Ban</th>
  </tr>
  <tr>
    <td class="productImg"><img src="http://placehold.it/100x100" alt="..." class="img-fluid"/></td>
    <td>arroubatudo</td>
    <td>a tua cor de pele incomoda me</td>
    <td>5</td>
    <td class="edit_cart ignore"><i class="far fa-thumbs-up fa-2x"></i></td>
    <td class="edit_cart offense"><i class="far fa-thumbs-down fa-2x"></i></td>
    <td class="edit_cart ban"><i class="fas fa-lock fa-2x"></i></td>
  </tr>
</table>
@endsection

@section('tab2Name','Banned Users')
@section('tab2')
<table class="table table-hover table-bordered">
  <tr class="info" style="color:#65768e">
    <th>Picture</th>
    <th>Name</th>
    <th>Ban Date (DD-MM-YYYY)</th>
    <th>Time Elapsed (Days)</th>
    <th>Unban</th>
  </tr>
  <tr>
    <td class="productImg"><img src="http://placehold.it/100x100" alt="..." class="img-fluid"/></td>
    <td>Joao Castanheira Cig</td>
    <td>27-02-2017</td>
    <td>20</td>
    <td class="edit_cart"><i class="fas fa-unlock-alt fa-2x"></i></td>
  </tr>
</table>
@endsection
