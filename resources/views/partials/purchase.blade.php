<tr>
  <td>
    <div id="opret-produkt" class="collapse in" style="margin-top: 10px">
      <div>
        <table class="table table-striped table-hover table-bordered">
          <tr class="info" style="color:#65768e;">
            <th>Item Name</th>
            <th>Cost</th>
          </tr>
          @foreach($products as $product)
            <tr>
              <td>{{$product->title}}</td>
              <td>{{$product->price}}</td>
            </tr>
          @endforeach
        </table>
    </div>
  </td>
  <td>$price</td>
  <td>$date</td>
  <td class="panel panel-default panel-help" href="#opret-produkt" data-toggle="collapse">
    <i class="fas fa-minus"></i>
    <i class="fas fa-minus"></i>
  </td>
</tr>
