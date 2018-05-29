<nav class="breadcrumb">
 @if ( $currPage != 'Homepage')
 <a class="breadcrumb-item" href="{{url('homepage')}}">Homepage</a>
 <span class="breadcrumb-item active">{{$currPage}}</span>
 @endif

 @if ( $currPage == 'My Profile')
 <i class="fas fa-question-circle" style="text-align:right;"  data-target="#exampleModalCenter" data-toggle="modal"></i>
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Online Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <p>My Profile</p>

        <p>Page to consult your customer profile of the online store "Sonic Flow". Here you can view and edit your profile, as well as check your shopping history and articles placed in favorites</p>
        <p>We have other options available in the left side menu:</p>
        <p>a) In the configurator customize your own pc.</p>
        <p>b) See the products of each category.</p>

        <p>For more information or if you notice any irregularities please <a href="{{route('contact')}}">Contact us</a>.  </p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@elseif( $currPage == 'Homepage')

<i class="fas fa-question-circle" style="float:right;" data-target="#exampleModalCenter" data-toggle="modal"></i>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Online Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <p>Home</p>
        <p>Homepage for the "Sonic Flow" online store. Here you can buy various technological products, compare products and even build your own pc suited to your needs. </p>
      At the beginning we highlight the products on sale. We have other options available in the left side menu: </p>
      <p>a) In the configurator customize your own pc.</p>
      <p>b) See the products of each category.</p>
      <p>For more information or if you notice any irregularities please  <a href="{{route('contact')}}">Contact us</a>. </p> 
    </div>
    <div class="modal-footer">
    </div>
  </div>
</div>
</div>
@elseif( $currPage == 'List Products')

<i class="fas fa-question-circle" style="float:right;" data-target="#exampleModalCenter" data-toggle="modal"></i>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Online Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <p>List Products</p>
        <p>Page to view products of the store by category.</p>
        <p>We have other options available in the left side menu:</p>
        <p>a) In the configurator customize your own pc.</p>
        <p>b) See the products of each category.</p>

        <p>For more information or if you notice any irregularities please <a href="{{route('contact')}}">Contact us</a>.  </p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
@endif
</nav>