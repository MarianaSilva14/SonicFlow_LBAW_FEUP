function menuAction(){
  document.querySelector("#wrapper").classList.toggle("active");
};

document.querySelector("#sidebar_menu").onclick = menuAction;
