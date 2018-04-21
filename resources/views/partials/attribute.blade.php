<div class="form-group row">
  <label for="{{$attribute->name}}" class="col-sm-3 col-form-label">{{$attribute->name}}</label>
  <div class="col-sm-9">
    <input type="text" readonly class="form-control-plaintext" id="{{$attribute->name}}" value="{{$attribute->value}}">
  </div>
</div>
