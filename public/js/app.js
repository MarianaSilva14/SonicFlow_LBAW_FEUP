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

//GLOBALS
var productOffset = 0;
var limit = 5;

function docOnLoad(){
  locArray = window.location.href.split("/");
  if(locArray[locArray.length-1].toLowerCase()=='homepage'){
      homepagePromotions();
      homepageBestSellers();
      homepageRecommendations();
  }
  if(locArray[locArray.length-1].toLowerCase()=='administration'){
    adminLoadProducts();
    product_offset=0;
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
    //alert('Successfully removed comment');
    let comment = document.getElementsByClassName('deletedComment');
    if(comment.length!=0){
      comment[0].innerHTML="{Content Deleted}";
    }
  }
}

function deleteCommentAction(id){
  sendAjaxRequest('DELETE','/comment/'+id,null,deleteCommentHandler);
  event.target.parentNode.classList.add('deletedComment');
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

function productAmmountCheck(event){
  console.log(event.target.value);
  console.log(event.target.nextElementSibling.innerHTML);
  let boxes = document.getElementsByClassName('availability');
  let addCart = document.getElementsByClassName('addToCart');
  if(parseInt(event.target.value) > parseInt(event.target.nextElementSibling.innerHTML)){
    console.log('HERE');
    boxes[0].hidden = true;
    boxes[1].hidden = false;
    addCart[0].disabled = true;
    addCart[0].children[0].style.textDecoration = 'line-through';
  }else{
    boxes[0].hidden = false;
    boxes[1].hidden = true;
    addCart[0].disabled = false;
    addCart[0].children[0].style.textDecoration = 'none';
  }
}

function addAmountChangeListener() {
  let input = document.querySelector('#amount');
  if (input != undefined) {
    input.onchange = productAmmountCheck;
  }
}

function showAdminProduct(product) {
  let row = document.createElement('tr');
  console.log(row);
  let innerHTMLbuild = "<td class='delete_cart'><i class='far fa-trash-alt fa-2x'></i></td><td class='productImg'><img style='max-width:70px'";
  if(product.picture != null){
    let imgUrl = product.picture.split(";")[0];
    innerHTMLbuild += "src='"+imgUrl.replace("public","\/storage")+"'";
  }
  innerHTMLbuild += "alt='product picture' class='img-fluid'/></td><td><a href='/product/"+product.sku+"'>"+product.title+"</a></td><td class='unitCost'>€"+product.price+"</td><td class='unitCost'>€"+product.discountprice+"</td><td class='amount'>"+product.stock+"</td><td class='edit_cart' onclick=\"location.href='/product/"+product.sku+"/edit'\"><i class='far fa-edit fa-2x'></i></td>";
  row.innerHTML = innerHTMLbuild;
  let table = document.querySelector('table.table');
  table.appendChild(row);
}

function allProductLoadHandler() {
  if(this.status != 200){
    alert('Error: '+this.status);
    return;
  }
  let products = JSON.parse(this.response);
  if(products.length < limit){
    let button = document.querySelector("#showMore");
    button.hidden=true;
  }else{
    productOffset += limit;
  }
  for (let product of products){
    showAdminProduct(product);
  }
}

function searchProductLoadHanlder() {

}

function adminLoadProducts() {
  sendAjaxRequest('GET','/api/products?limit='+limit+'&offset='+productOffset,null,allProductLoadHandler);
}

function addShowMoreClickListener() {
  let button = document.querySelector('#showMore');
  if(button!=null){
    button.onclick = adminLoadProducts;
  }
}


function homepagePromotionsHandler() {
    console.log('got promotions');
    if(this.status != 200){
        alert('Error promo: '+this.status);
        return;
    }
    let products = JSON.parse(this.response);
    let recommendations = document.querySelector('#promo > .row');
    recommendations.innerHTML = "";
    for (let product_html of products){
        recommendations.innerHTML += product_html;
    }
    updateFavoriteList();
}

function homepageBestSellersHandler() {
    console.log('got best sellers');
    if(this.status != 200){
        alert('Error bs: '+this.status);
        console.log(this.response);
        return;
    }
    let products = JSON.parse(this.response);
    let recommendations = document.querySelector('#bestsellers > .row');
    recommendations.innerHTML = "";
    for (let product_html of products){
        recommendations.innerHTML += product_html;
    }
    updateFavoriteList();
}

function homepageRecommendationsHandler() {
    console.log('got recommendations');
    if(this.status != 200){
        alert('Error reco: '+this.status);
        console.log(this.response);

        return;
    }
    let products = JSON.parse(this.response);
    let recommendations = document.querySelector('#recommended > .row');
    recommendations.innerHTML = "";
    for (let product_html of products){
        recommendations.innerHTML += product_html;
    }
    updateFavoriteList();
}


function homepagePromotions() {
    sendAjaxRequest('GET','/api/discounts?limit='+limit,null,homepagePromotionsHandler);
}

function homepageBestSellers() {
    sendAjaxRequest('GET','/api/bestsellers?limit='+limit,null,homepageBestSellersHandler);
}

function homepageRecommendations() {
    sendAjaxRequest('GET','/api/recommendations?limit='+limit,null,homepageRecommendationsHandler);
}

function addFavoriteToggleHandler() {
  console.log(this);
  if(this.status != 200){
    console.log(this.responseText);
    alert("Couldn't favorite product, please retry.");
  }else{
    //let button = document.querySelector();
    let button = document.querySelector(".addFavs svg");
    if(button.dataset.prefix=='fas'){
      button.dataset.prefix='far';
    }else{
      button.dataset.prefix='fas';
    }
  }
}

function addFavoriteToggleAction() {
  let productId = document.querySelector("#stars_rating");
  sendAjaxRequest('POST','/users/favorites/'+productId.dataset.id,null,addFavoriteToggleHandler);
  event.preventDefault();
}

function addFavoriteToggleListener() {
  let button = document.querySelector(".addFavs");
  if(button != null)
    button.onclick = addFavoriteToggleAction;
}
function sendFavoriteRequest(event){
  console.log("HERE");

  let id_product = this.closest('.heart_favorite').getAttribute('data-id');

  sendAjaxRequest('POST', '/users/favorites/'+id_product,null,receiveFavoriteHandler);

  event.preventDefault();
}

function receiveFavoriteHandler(){
    console.log(this);
  if(this.status != 200){
    alert("Favorites list couldn't be updated");
  }
  else
      alert('All good');
}

function updateFavoriteList(){
  let hearts = document.querySelectorAll(".heart_favorite");
    for(var i of hearts){
        i.addEventListener('click', sendFavoriteRequest);
    }
}

updateRatingOfProduct();
removeFavoritesButton();
productLinks();
productUpdateAddListener();
addAmountChangeListener();
addFavoriteToggleListener();
addShowMoreClickListener();
