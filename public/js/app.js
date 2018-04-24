function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

$(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).html();
		$('.search-panel span#catSelect').html(concept);
		$('.input-group #search_param').val(param);
	});
});

// function loadProductsHandler() {
//
//   <div class="outbox col-xl-3 col-md-4">
//                   <div class="ibox">
//                     <div class="ibox-content product-box">
//                       <div class="product-imitation">
//                         <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/22/05/13/1246498/1505-1.jpg" alt="194x228" class="img-fluid">
//                       </div>
//                       <div class="product-desc">
//                         <div class="priceTags">
//                           <span class="bg-danger discount-price">
//                             599,99 €
//                           </span>
//                           <span class="product-price">
//                             649,99 €
//                           </span>
//                         </div>
//                         <br>
//                         <small class="text-muted">Category</small>
//                         <a href="product.html" class="product-name"> Portátil Asus</a>
//                         <div class="small m-t-xs">
//                           Many desktop publishing packages and web page editors now.
//                         </div>
//                         <br>
//                         <div class="m-t text-righ row">
//                           <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <svg class="svg-inline--fa fa-cart-plus fa-w-18" aria-hidden="true" data-prefix="fas" data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg><!-- <i class="fas fa-cart-plus"></i> --></a>
//                           <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><svg class="svg-inline--fa fa-heart fa-w-18" aria-hidden="true" data-prefix="far" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M257.3 475.4L92.5 313.6C85.4 307 24 248.1 24 174.8 24 84.1 80.8 24 176 24c41.4 0 80.6 22.8 112 49.8 31.3-27 70.6-49.8 112-49.8 91.7 0 152 56.5 152 150.8 0 52-31.8 103.5-68.1 138.7l-.4.4-164.8 161.5a43.7 43.7 0 0 1-61.4 0zM125.9 279.1L288 438.3l161.8-158.7c27.3-27 54.2-66.3 54.2-104.8C504 107.9 465.8 72 400 72c-47.2 0-92.8 49.3-112 68.4-17-17-64-68.4-112-68.4-65.9 0-104 35.9-104 102.8 0 37.3 26.7 78.9 53.9 104.3z"></path></svg><!-- <i class="far fa-heart"></i> --></a>
//                         </div>
//                       </div>
//                     </div>
//                   </div>
//                 </div>
// }

function loadProducts(){
  //sendAjaxRequest('GET','api/discounts',null,loadProductsHandler)
}

function docOnLoad(){
  locArray = window.location.href.split("/");
  if(locArray[locArray.length-1].toLowerCase()=='homepage'){
    loadProducts();
  }
}

document.onload = docOnLoad();

function insertAfter(newNode,referenceNode){
  referenceNode.parentNode.insertBefore(newNode,referenceNode.nextSibling);
}

function removeFavoritesAction(){
  var elementNode = this.nextElementSibling;
  var productId = elementNode.innerHTML;
  sendAjaxRequest('delete','/users/favorites/'+productId,{'sku':productId},removeFavoritesHandler);
  event.preventDefault();
}

function removeFavoritesHandler(){
  if(this.status != 200){
    alert('Delete went wrong');
  }
}

function removeFavoritesButton(){
  var buttons = document.querySelectorAll("div#favorites .rmFromFavs");

  for (var button of buttons) {
    button.addEventListener('click',removeFavoritesAction);
  }
}

function productLinks(){
  var images = document.querySelectorAll(".product-imitation");
  for (var image of images) {
    image.onclick = function(event){
      window.location = this.nextElementSibling.querySelector('.product-name').href;
    }
  }
}

function commentReplyAction(productId,commentId){
  let replyForm;
  let previousForm = document.querySelector('div.replyForm');
  if (previousForm != undefined) {
    replyForm=previousForm;
    previousForm.remove();
  }else{
    oldForm = document.querySelector('div.newCommentForm');
    replyForm = oldForm.cloneNode(true);
    replyForm.classList.remove("newCommentForm");
    replyForm.classList.add("replyForm");
  }
  let commentRow = event.target.closest("div.row");
  insertAfter(replyForm,commentRow);
  let input = document.getElementsByClassName('parentId');
  input[0].setAttribute('value',commentId);
}

function productUpdateAddListener(){
  let inputs = document.querySelectorAll('form.editProduct input,form.editProduct textarea');
  for (var input of inputs) {
    input.onchange = function(){
      let submit = document.getElementsByClassName('saveChanges');
      submit[0].hidden=false;
    }
  }
}

function flagCommentHandler(){
  if(this.status != 200){
    alert('Flag of comment went wrong');
    alert(this.responseText);
  }else if(this.status == 200){
    alert('Successfully flagged comment');
  }
}

function flagCommentAction(id){
  sendAjaxRequest('get','/comment/'+id+'/flag',null,flagCommentHandler);
  event.preventDefault();
}

function deleteCommentHandler(){
  if(this.status != 200){
    alert('Comment deletion went wrong');
    alert(this.responseText);
  }else if(this.status == 200){
    alert('Successfully removed comment');
    //delete text change
  }
}

function deleteCommentAction(id){
  sendAjaxRequest('DELETE','/comment/'+id,null,deleteCommentHandler);
  event.preventDefault();
}

function approveCommentHandler(){
  if(this.status != 200){
    alert('Comment approval went wrong');
    alert(this.responseText);
  }else if(this.status == 200){
    alert('Successfully approved comment');
    //delete text change
  }
}

function approveCommentAction(id){
  sendAjaxRequest('GET','/comment/'+id+'/approve',null,approveCommentHandler);
  event.preventDefault();
}

function sendRatingRequest(event){
  let value = this.previousElementSibling.getAttribute('value');
  console.log(value);

  console.log("HERE");

  let id_product = this.closest('#stars_rating').getAttribute('data-id');

  if(value != ''){
    sendAjaxRequest('POST', '/product/'+id_product+'/rating',{value:value},receiveRatingHandler);
  }
  event.preventDefault();
}

function receiveRatingHandler(){
  console.log(this);
  if(this.status != 200){
    alert("Rating couldn't be updated");
  }else{
    let stars = document.querySelectorAll("#rating input#star"+JSON.parse(this.responseText));
    stars[0].checked=true;
  }
}

function updateRatingOfProduct(){
  let inputs = document.querySelectorAll("#rating svg");

  for(var i of inputs){
    i.addEventListener('click', sendRatingRequest);
  }
}

updateRatingOfProduct();
removeFavoritesButton();
productLinks();
productUpdateAddListener();
