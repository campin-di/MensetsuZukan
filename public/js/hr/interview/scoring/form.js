window.onload = function(){
  if(interview['zoomUrl'] !== 'done'){
    window.open(interview['zoomUrl'], '_blank');
  }
}

// == begin；採点バー 部分 ======================================================
var elem = document.getElementsByClassName('range');

var rangeValue = function (elem, target) {
  return function(evt){
    target.innerHTML = elem.value;
  }
}

for(var i = 0, max = elem.length; i < max; i++){
  bar = elem[i].getElementsByTagName('input')[0];
  target = elem[i].getElementsByTagName('span')[0];
  bar.addEventListener('input', rangeValue(bar, target));
}
// == end；採点バー 部分 ========================================================
