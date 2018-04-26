<tr>
  <td>
    @foreach($products as $product)
      @if($loop->first && $loop->last)
        {{$product->quantity}}*{{$product->title}}
        @break
      @endif
      {{$product->quantity}}*{{$product->title}}
      @if($loop->index == 1 && !$loop->last)
        , ...
        @break
      @elseif(!$loop->last)
        ,
      @endif
    @endforeach
    <div id="opret-produkt" class="collapse in" style="margin-top: 10px">
      <div>
        <table class="table table-striped table-hover table-bordered">
          <tr class="info" style="color:#65768e;">
            <th>Item Name</th>
            <th>Cost</th>
          </tr>
          @foreach($products as $product)
            @for ($i = 0; $i < $product->quantity; $i++)
              <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->price}}</td>
              </tr>
            @endfor
          @endforeach
        </table>
    </div>
  </td>
  <td>{{$price}}</td>
  <td>{{$date}}</td>
  <td class="panel panel-default panel-help" href="#opret-produkt" data-toggle="collapse">
    <i class="fas fa-minus"></i>
    <i class="fas fa-minus"></i>
  </td>
</tr>
