$(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).html();
		$('.search-panel span#catSelect').html(concept);
		$('.input-group #search_param').val(param);
	});
});

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
  var images = document.querySelectorAll(".product-imitation")
  for (var image of images) {
    image.onclick = function(event){
      window.location = this.nextElementSibling.querySelector('.product-name').href;
    }
  }
}

removeFavoritesButton();
productLinks();
