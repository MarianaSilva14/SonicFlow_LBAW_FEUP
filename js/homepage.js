function menuAction(e){
  document.querySelector("#wrapper").classList.toggle("active");
  e.preventDefault();
}

document.querySelector("#menu-toggle").onclick = menuAction;
