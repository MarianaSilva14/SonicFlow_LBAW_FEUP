<div class="compareOverlay minimized" @if(!array_key_exists('compareProducts',$_COOKIE) || strlen($_COOKIE['compareProducts'])<4)hidden @endif>
  <p>Compare</p>
  <i id="compareOverlayClose" class="fas fa-times close"></i>
  <i id="compareOverlayMinimize" class="fas fa-minus close"></i>
  <div class="form-group row mx-0">
    @foreach($compareProds as $prod)
      <div class="col-sm-2 @if($loop->first)offset-1 @endif thumbnails">
        <span class="compareItemRemove" data-sku="{{$prod->sku}}"><i class="fas fa-times"></i></span>
        @if( $prod->picture == null)
        <img src="https://cdn0.iconfinder.com/data/icons/business-mix/512/cargo-512.png" alt="Image for {{ $prod->title }}" class="img-fluid">
        @else
        <img src="{{ Storage::url($prod->picture) }}" alt="Image for {{ $prod->title }}" class="img-fluid">
        @endif
        <p> {{$prod->title}} </p>
      </div>
    @endforeach
    <div class="col-sm-2 my-auto">
      <a href="{{route('comparator')}}" class="btn btn-primary">Compare Now!</a>
    </div>
  </div>
</div>
