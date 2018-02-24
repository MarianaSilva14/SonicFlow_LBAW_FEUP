var handlerStorage;
var openOverlay;

let tipsButton = document.querySelectorAll("a.toggle-tips");
for (let tips of tipsButton) {
  tips.onclick = tipsToggle;
}

function tipsToggle(evt){
  evt.preventDefault();
  evt.stopPropagation();
  let target = evt.target.closest("a.toggle-tips");
  if(openOverlay == undefined && target!==null){
    console.log("undefined");
    console.log(evt.target);
    console.log(target);
    target.previousElementSibling.classList.toggle('hidden');
    openOverlay = target;
    handlerStorage = document.onclick;
    document.onclick = tipsToggle;
  }else if(openOverlay !== undefined){
    console.log("defined");
    openOverlay.previousElementSibling.classList.toggle('hidden');
    document.onclick = handlerStorage;
    openOverlay = undefined;
  }
}
