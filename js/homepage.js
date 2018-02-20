function menuAction(e){
  document.querySelector("#wrapper").classList.toggle("active");
  e.preventDefault();
}

document.querySelector("#menu-toggle").onclick = menuAction;

window.onscroll = function() {myFunction()};

function myFunction() {
  let className = "header-short";
  if (document.body.scrollTop >= 60 || document.documentElement.scrollTop >= 60){
    document.querySelector("header").classList.add(className);
    document.querySelector("body").classList.add(className);
    document.querySelector("#logo-short").classList.add(className);
    document.querySelector("#logo").classList.add(className);
  }
  else if(document.body.scrollTop < 60 || document.documentElement.scrollTop < 60){
    document.querySelector("header").classList.remove(className);
    document.querySelector("body").classList.remove(className);
    document.querySelector("#logo-short").classList.remove(className);
    document.querySelector("#logo").classList.remove(className);
  }
}
