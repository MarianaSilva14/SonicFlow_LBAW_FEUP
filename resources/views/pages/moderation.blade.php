@extends('layouts.admin')

@section('title','Moderator')

@section('tab1Name','Flagged Comments')
@section('tab1')
<table class="table table-hover table-bordered">
  <tr class="info" style="color:#65768e">
    <th>Picture</th>
    <th>Username</th>
    <th>Comment</th>
    <th>Flag Number</th>
    <th>Number Offenses</th>
    <th>Ignore</th>
    <th>Add offense</th>
    <th>Ban</th>
  </tr>
  @foreach($comments as $comment)
    <tr>
      @if($comment->picture=="")
        <td class="productImg"><img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" alt="User Picture" style="max-width:70px" class="img-fluid"/></td>
      @else
        <td class="productImg"><img src="{{Storage::url($comment->picture)}}" alt="User Picture" style="max-width:70px" class="img-fluid"/></td>
      @endif
      <td>{{$comment->username}}</td>
      <td>{{$comment->commentary}}</td>
      <td>{{$comment->flagsno}}</td>
      <td>TODO</td>
      <td class="edit_cart ignore" onclick="approveCommentAction({{$comment->id}})"><i class="far fa-thumbs-up fa-2x"></i></td>
      <td class="edit_cart offense" data-id={{$comment->id}}><i class="far fa-thumbs-down fa-2x"></i></td>
      <td class="edit_cart ban" data-id={{$comment->username}}><i class="fas fa-lock fa-2x"></i></td>
    </tr>
  @endforeach
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
  @foreach($banned as $ban)
  <tr>
    <td class="productImg"><img src="http://placehold.it/100x100" alt="..." class="img-fluid"/></td>
    <td>{{$ban->username}}</td>
    <td>{{Carbon\Carbon::parse($ban->banneddate)->toDateTimeString()}}</td>
    <td>{{Carbon\Carbon::parse($ban->banneddate)->diffForHumans()}}</td>
    <td class="edit_cart"><i class="fas fa-unlock-alt fa-2x"></i></td>
  </tr>
  @endforeach
</table>
@endsection
