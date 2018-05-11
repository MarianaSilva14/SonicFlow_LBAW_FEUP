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

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  if(exdays!=undefined){
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }else{
    console.log("ExpDays are null");
    document.cookie = cname + "=" + cvalue+";path=/";
  }
}
function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}
function removeCookie(cname,path) {
  if(cname){
    setCookie(cname,'lol');
    document.cookie = cname+"=lol; expires=Thu, 01 Jan 1970 00:00:00 GMT; path="+path+";";
  }
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

if(getCookie('shoppingCart') == ""){
  setCookie('shoppingCart',JSON.stringify({}));
}

//GLOBALS
var productOffset = 0;
var limit = 5;
var cartItemAmount;
var currentProducts = [];

function docOnLoad(){
  locArray = window.location.href.split("/");
  console.log(locArray);
  if(locArray[locArray.length-1].toLowerCase().includes('homepage')){
    homepagePromotions();
    homepageBestSellers();
    homepageRecommendations();
  }
  if(locArray[locArray.length-1].toLowerCase().includes('administration')){
    adminLoadProducts();
    product_offset=0;
  }
  if(locArray[3].toLowerCase().includes('product')){
    setTimeout(updateRatingOfProduct, 200);
    addProductToCart();
  }
  cartItemAmount = Object.keys(JSON.parse(getCookie('shoppingCart'))).length;
  if(cartItemAmount!=0){
    let icon = document.getElementsByClassName('shoppingCart')[0];
    $(icon).attr('data-before',"("+cartItemAmount+")");
  }
}

document.onload = docOnLoad();

var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
}

// // Change hash for page-reload
// $('.nav-tabs a').on('shown.bs.tab', function (e) {
//     window.location.hash = e.target.hash;
// })

function insertAfter(newNode,referenceNode){
  referenceNode.parentNode.insertBefore(newNode,referenceNode.nextSibling);
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
  console.log(inputs);
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
function flagCommentAction(event, id){
  sendAjaxRequest('get','/comment/'+id+'/flag',null,flagCommentHandler);
  event.preventDefault();
}

function deleteCommentHandler(){
  if(this.status != 200){
    alert('Comment deletion went wrong');
    console.log(this.responseText);
  }else if(this.status == 200){
    //alert('Successfully removed comment');
    let comment = document.getElementsByClassName('deletedComment');
    if(comment.length!=0){
      if(comment[0].tagName == 'TR')
        comment[0].remove();
      else
        comment[0].innerHTML="{Content Deleted}";
    }
  }
}
function deleteCommentAction(){
  sendAjaxRequest('DELETE','/comment/'+this.dataset.id,null,deleteCommentHandler);
  console.log(this);
  this.parentNode.classList.add('deletedComment');
  event.preventDefault();
}
function deleteComment() {
  let commentDeleted = document.querySelectorAll('.offense, .deleteLink');

  for (let comment of commentDeleted) {
    comment.onclick = deleteCommentAction;
  }
}

function banUserHandler(){
  if(this.status != 200){
    alert('User banned unsuccessfully');
    console.log(this.responseText);
  }
  else{
    alert('User banned successfully');
    let rows = document.querySelectorAll("td[data-id='"+this.responseText+"']");
    for (let row of rows) {
      row.parentNode.remove();
    }
  }
}
function banUserAction(){
  sendAjaxRequest('PUT', 'users/'+this.dataset.id+'/ban',null,banUserHandler);
  event.preventDefault();
}
function banUser(){
  let banUser = document.querySelectorAll('.ban');

  for(let ban of banUser){
    ban.onclick = banUserAction;
  }
}

function unBanUserHandler(){
  if(this.status != 200){
    alert('User unbanned unsuccessfully');
    console.log(this.responseText);
  }
  else{
    let unBan = document.getElementsByClassName('unBanUser');

    if(unBan.length != 0){
      if(unBan[0].tagName == 'TR')
        unBan[0].remove();
    }
    alert('User unbanned successfully');

  }
}
function unBanUserAction(){
  sendAjaxRequest('DELETE', 'banned/'+this.dataset.id,null,unBanUserHandler);
  console.log(this);
  this.parentNode.classList.add('unBanUser');
  event.preventDefault();
}
function unBanUser(){
  let unBanUser = document.querySelectorAll('.unban');

  for(let unBan of unBanUser){
    unBan.onclick = unBanUserAction;
  }
}

function approveCommentHandler(event){
  if(this.status != 200){
    alert('Comment approval went wrong');
    alert(this.responseText);
  }else if(this.status == 200){
    alert('Successfully approved comment');
    let tableRow = document.querySelector("td[data-id='"+this.responseText+"']").parentNode;
    tableRow.remove();
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
  let id_product = this.closest('#stars_rating').getAttribute('data-id');
  if(value != ''){
    sendAjaxRequest('POST', '/product/'+id_product+'/rating',{value:value},receiveRatingHandler);
  }
  event.preventDefault();
}

function receiveRatingHandler(){
  if(this.status != 200){
    alert("Rating couldn't be updated");
    console.log(this.responseText);
  }else{
    let stars = document.querySelectorAll("#rating input#star"+JSON.parse(this.responseText));
    stars[0].checked=true;
  }
}
function updateRatingOfProduct(){
  let inputs = document.querySelectorAll("#rating svg");
  console.log(inputs);
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
  innerHTMLbuild += "alt='product picture' class='img-fluid'/></td><td><a href='/product/"+product.sku+"'>"+product.title+"</a></td><td class='unitCost'>"+product.price+"€</td><td class='unitCost'>"+((product.discountprice != null) ? (product.discountprice+'€') : 'undefined')+"</td><td class='amount'>"+product.stock+"</td><td class='edit_cart' onclick=\"location.href='/product/"+product.sku+"/edit'\"><i class='far fa-edit fa-2x'></i></td>";
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
function adminSearchProductHanlder() {
  if(this.status != 200){
    alert('Search for a product went wrong');
    console.log(this.responseText);
  }
  let products = JSON.parse(this.responseText);
  let button = document.querySelector("#showMore");
  if(products.length != limit){
    button.hidden=true;
  }else{
    productOffset += limit;
    button.hidden=false;
  }
  let table = document.querySelector('table.table');
  let header = table.firstElementChild;
  table.innerHTML = "";
  table.appendChild(header);
  if(products.length==0){
    let newRow = document.createElement('TR');
    newRow.innerHTML = "<td colspan=7>No products available</td>";
    table.appendChild(newRow);
  }else{
    for (let product of products){
      showAdminProduct(product);
    }
  }
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
function adminSearchProductAction(event){
  productOffset = 0;
  let cat = this.parentNode.children[1].value;
  console.log('Category:'+cat+':');
  let title = this.previousElementSibling.value;
  console.log('Title:'+title+':');
  let newLimit = "";
  if(cat == "" || title == ""){
    newLimit = 5;
  }
  console.log('Limit:'+newLimit+':');
  sendAjaxRequest('GET','api/products?categoryID='+cat+'&title='+title+'&limit='+limit,null,adminSearchProductHanlder);
  event.preventDefault();
}
function adminSearchProduct(){
  let searchProduct = document.querySelectorAll('.adminSearchBtn');
  for (let search of searchProduct) {
    search.onclick = adminSearchProductAction;
    search.previousElementSibling.onkeyup = function(event){
      if(event.key=='Enter'){
        $(this.nextElementSibling).trigger('click');
      }
    }
  }
}

function headerSearchProductAction() {
  productOffset = 0;
  let cat = this.parentNode.children[1].value;
  console.log('Category:'+cat+':');
  let title = this.previousElementSibling.value;
  console.log('Title:'+title+':');
  window.location.href = $(this).attr('href')+'?categoryID='+cat+'&title='+title;
  event.preventDefault();
}
function headerSearchProduct() {
  let searchProduct = document.querySelectorAll('.headerSearchBtn');
  for (let search of searchProduct) {
    search.onclick = headerSearchProductAction;
    search.previousElementSibling.onkeyup = function(event){
      if(event.key=='Enter'){
        $(this.nextElementSibling).trigger('click');
      }
    }
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
  addFavoriteToggleListener();
  addProductToCart();
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
  addFavoriteToggleListener();
  addProductToCart();
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
  addFavoriteToggleListener();
  addProductToCart();
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
    let buttons = document.querySelectorAll("a[data-id='"+this.responseText+"'].addFavs svg");
    for (let button of buttons) {
      if(button.dataset.prefix=='fas'){
        button.dataset.prefix='far';
      }else{
        button.dataset.prefix='fas';
      }
    }
  }
}
function addFavoriteToggleAction(event){
  let id_product = this.closest('.heart_favorite').getAttribute('data-id');
  sendAjaxRequest('POST', '/users/favorites/'+id_product,null,addFavoriteToggleHandler);
  event.preventDefault();
}
function addFavoriteToggleActionProduct(event){
  productId = document.querySelector("#stars_rating");
  sendAjaxRequest('POST','/users/favorites/'+productId.dataset.id,null,addFavoriteToggleHandler);
  event.preventDefault();
}
function addFavoriteToggleListener(){
  let hearts = document.querySelectorAll(".heart_favorite");
  for(var i of hearts){
      i.addEventListener('click', addFavoriteToggleAction);
  }
}
function addFavoriteToggleListenerProduct(){
  let button = document.querySelector(".addFavs");
  if(button != null)
    button.onclick = addFavoriteToggleActionProduct;
}

function removeFavoritesHandler(){
  if(this.status != 200){
    console.log(this.responseText);
    alert("Couldn't remove favorite product, please retry.");
  }else{
    let button = document.querySelector("a[data-id='"+this.responseText+"'].rmFromFavs");
    button.closest(".outbox").remove();
  }
}
function removeFavoritesAction(event){
  sendAjaxRequest('delete','/users/favorites/'+this.dataset.id,null,removeFavoritesHandler);
  event.preventDefault();
}
function removeFavoritesButton(){
  var buttons = document.querySelectorAll("div#favorites .rmFromFavs");
  for (var button of buttons) {
    button.addEventListener('click',removeFavoritesAction);
  }
}

function retreivePurchaseHistoryHandler() {
  if(this.status != 200){
    console.log(this.responseText);
    alert("Couldn't get purchase history, please retry.");
  }else{
    let purchases = JSON.parse(this.responseText);
    let table = document.getElementById('purchaseTable');
    if(purchases.length!=0){
      for (let purchase of purchases) {
        table.children[0].innerHTML += purchase;
      }
    }else{
      table.children[0].innerHTML += "<tr><td colspan='4'>No registered purchases available</td></tr>"
    }
  }
}
function retreivePurchaseHistoryAction(){
  let table = document.getElementById('purchaseTable').children[0]
  if(!this.classList.contains('show') && table.children.length<=1){
    let userId = document.querySelector("input[name='username']").value;
    sendAjaxRequest('GET','/users/'+userId+'/purchasehistory',null,retreivePurchaseHistoryHandler);
  }else{
    console.log("don't load");
  }
}
function retreivePurchaseHistory(){
  let input = document.getElementById('purchaseHistory-tab');
  if (input!=null)
    input.onclick = retreivePurchaseHistoryAction;
}

function retreiveFavoritesHandler() {
  if(this.status != 200){
    console.log(this.responseText);
    alert("Couldn't get favorite products, please retry.");
  }else{
    let favorites = JSON.parse(this.responseText);
    let row = document.getElementById('favorites');
    if(favorites.length!=0){
      for (let favorite of favorites) {
        row.children[0].innerHTML += favorite;
      }
      removeFavoritesButton();
    }else{
      row.children[0].innerHTML = "<tr><td colspan='4'>No favorite products available</td></tr>"
    }
  }
}
function retreiveFavoritesAction(){
  let row = document.getElementById('favorites').children[0]
  if(!this.classList.contains('show') && row.children.length<=0){
    let userId = document.querySelector("input[name='username']").value;
    sendAjaxRequest('GET','/users/'+userId+'/favorites',null,retreiveFavoritesHandler);
  }else{
    console.log("Don't load favorites");
  }
}
function retreiveFavorites(){
  let input = document.getElementById('favorites-tab');
  if(input!=null)
    input.onclick = retreiveFavoritesAction;
}

function addProductToCartAction(){
  let id;
  let amount = 1;
  if (this.tagName == 'BUTTON') {
    id = document.querySelector('.addFavs').dataset.id;
    amount = parseInt(document.getElementById('amount').value);
    console.log('id ='+id);
    console.log('amount:'+amount);
  }else{
    id = this.nextElementSibling.dataset.id;
  }
  let productArray = JSON.parse(getCookie('shoppingCart'));
  if(productArray[id] == undefined){
    productArray[id]=amount;
    let icon = document.getElementsByClassName('shoppingCart')[0];
    if (icon != null) {
      cartItemAmount++;
      $(icon).attr('data-before',"("+cartItemAmount+")");
    }
  }else{
    productArray[id]+=amount;
  }
  setCookie('shoppingCart',JSON.stringify(productArray));
}
function addProductToCart(){
  let buttons = document.querySelectorAll(".addToCart");
  for (let button of buttons) {
    button.onclick = addProductToCartAction;
  }
}

function shoppingCartAction(event) {
  window.location.href = this.href+"?shoppingCart="+getCookie('shoppingCart');
  event.preventDefault();
}
function shoppingCart() {
  let button = document.getElementsByClassName('shoppingCart');
  if (button[0] != null) {
    button[0].onclick = shoppingCartAction;
  }
}

function checkoutAction(event) {
  window.location.href = this.href+"?shoppingCart="+getCookie('shoppingCart');
  event.preventDefault();
}
function checkout() {
  let button = document.querySelector('.checkoutCost + a');
  if (button != null) {
    button.onclick = checkoutAction;
  }
}

function removeAllItemsInCartAction(event) {
  setCookie('shoppingCart',JSON.stringify({}));
  let table = document.querySelector('table#shoppingCartTable tbody');
  if(table!=null){
    let max = table.children.length;
    for (var i = max-1; i >= 1; i--) {
      table.children[i].remove();
    }
    let row = document.createElement('TR');
    if(row!=null){
      row.innerHTML = "<td colspan = 6>No products currently on shopping cart</td>";
      table.appendChild(row);
    }
  }
  // console.log(this);
  if(!this.classList.contains('logout')){
    event.preventDefault();
  }
}
function removeAllItemsInCart() {
  let buttons = document.querySelectorAll('.removeAll,.logout');
  for (let button of buttons) {
    button.onclick = removeAllItemsInCartAction;
  }
}

function removeItemInCartAction() {
  let products = JSON.parse(getCookie('shoppingCart'));
  products[this.dataset.id] = undefined;
  setCookie('shoppingCart',JSON.stringify(products));
  this.parentNode.remove();
  if(this.parentNode.children.length==1){
    let row = document.createElement('TR');
    row.innerHTML = "<td colspan = 6>No products currently on shopping cart</td>";
    this.parentNode.appendChild(row);
  }
}
function removeItemInCart(){
  let buttons = document.getElementsByClassName('removeSingle');
  for (let button of buttons) {
    button.onclick = removeItemInCartAction;
  }
}

function amountAdjustAction(){
  let previousValue = parseFloat(this.parentNode.nextElementSibling.innerHTML);

  if(this.value == "" || this.value == null || this.value == '0')
      this.value = "1";

  if(parseInt(this.value)>parseInt(this.max)){
    this.value = this.max;
  }
  let newValue = Math.round(parseFloat(this.parentNode.previousElementSibling.innerHTML)*parseInt(this.value)*100)/100;
  this.parentNode.nextElementSibling.innerHTML = newValue+'€';
  let total = document.querySelector('strong.checkoutCost');
  total.innerHTML = Math.round((parseFloat(total.innerHTML)-previousValue+newValue)*100)/100+'€';

  // parent node - > first child

  let id = this.parentNode.parentNode.firstElementChild.dataset.id;
  let productArray = JSON.parse(getCookie('shoppingCart'));
  productArray[id] = parseInt(this.value);
  setCookie('shoppingCart',JSON.stringify(productArray));
  console.log(id);

}
function amountAdjust(){
  let inputs = document.querySelectorAll("td.amount input");
  for (let input of inputs) {
    input.onchange = amountAdjustAction;
  }
}

function configuratorAmountAdjustAction(){
  let previousValue = parseFloat(this.closest('div.form-row').lastElementChild.children[1].value);
  console.log("previousValue: "+previousValue);

  if(this.value == "" || this.value == null || this.value == '0')
      this.value = "1";

  if(parseInt(this.value)>parseInt(this.max)){
    this.value = this.max;
  }
  let newValue = Math.round(parseFloat(this.parentNode.previousElementSibling.children[1].value)*parseInt(this.value)*100)/100;
  this.closest('div.form-row').lastElementChild.children[1].value = parseFloat(newValue).toFixed(2)+'€';
  console.log("newValue: "+newValue);
  let total = document.querySelector('.sectionTitle.total span');
  total.innerHTML = parseFloat(Math.round((parseFloat(total.innerHTML)-previousValue+newValue)*100)/100).toFixed(2)+'€';
}
function configuratorAmountAdjust(){
  let inputs = document.querySelectorAll("input#caseAmount");
  for (let input of inputs) {
    input.onchange = configuratorAmountAdjustAction;
  }
}

function configuratorUnitCostAdjustAction() {
  let unitCost = this.parentNode.nextElementSibling.children[1];
  unitCost.value = this.value+"€";
  let amount = this.parentNode.nextElementSibling.nextElementSibling.children[1];
  amount.value=1;
  $(amount).trigger('onchange');
}
function configuratorUnitCostAdjust() {
  let inputs = document.querySelectorAll("select.prodChoice");
  for (let input of inputs) {
    input.onchange = configuratorUnitCostAdjustAction;
  }
}

function updatePriceLoyaltyPoints(evt){
  let lpoints = Math.trunc(document.querySelector("#loyaltyPointsInput").valueAsNumber/100);
  let real_price = parseFloat(document.querySelector("#totalPriceToPayBeforeDiscount").value);


  let price = document.querySelector("#totalPriceToPay");
  let number = real_price - lpoints;
  number =number.toFixed(2);

  if(number < 0){
    price.innerHTML = "0.01";
  }else{
    price.innerHTML = number.toString();
  }


}

adminSearchProduct();
headerSearchProduct();
removeAllItemsInCart();
removeItemInCart();
retreivePurchaseHistory();
retreiveFavorites();
shoppingCart();
checkout();
amountAdjust();
configuratorAmountAdjust();
configuratorUnitCostAdjust();
deleteComment();
banUser();
unBanUser();
//productLinks();
addAmountChangeListener();
addFavoriteToggleListener();
addFavoriteToggleListenerProduct();
productUpdateAddListener();
addShowMoreClickListener();
