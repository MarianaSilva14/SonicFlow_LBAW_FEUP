<div class="@if($reply) comment-reply @else comment @endif col-md-11 offset-md-1 col-sm-10 offset-sm-2">
  <div class="row">
    <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
      @if($comment->user->getPicture()=="")
        <img class="mx-auto rounded-circle img-fluid" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" alt="avatar">
      @else
        <img class="mx-auto rounded-circle img-fluid" src="{{\Illuminate\Support\Facades\Storage::url($comment->user->getPicture())}}" alt="avatar">
      @endif
    </div>
    <div class="comment-content col-md-11 col-sm-10 col-12">
      <h6 class="small comment-meta"><a href="#">{{$comment->user->username}}</a> {{Carbon\Carbon::parse($comment->date)->diffForHumans()}}</h6>
      <div class="comment-body">
        <p>
          @if($comment->deleted)
            {Content Deleted}
          @else
            {{$comment->commentary}}
          @endif
          <br>
          <a href="" class="text-right small"><i class="fas fa-reply"></i> Reply</a>
          <a href="" class="text-right small text-danger"><i class="fas fa-flag"></i> Flag</a>
          <p class="commentId" hidden>{{$comment->id}}</p>
        </p>
      </div>
    </div>
  </div>
  @foreach($comment->answers as $nextComment)
    @include('partials.comment',['reply'=>TRUE,'comment'=>$nextComment])
  @endforeach
</div>
