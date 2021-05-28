//textが20文字より多い場合は、前者が返され、少ない場合は後者が返される。
const cutString = ($text, $length) => {
  let slicetext = $text.length > $length ? ($text).slice(0, $length)+"…" : $text;

  return slicetext;
}

//得点の背景色を変更する関数
const changeBackgroundColor = ($scores) => {
  $scores.forEach(scoreElement => {
    let score = scoreElement.children[0].innerText;

    if(score >= 60 && score < 70){
      scoreElement.style.background = "linear-gradient(to right, #537895, #09203f)";
    } else if(score >= 70 && score < 80){
      scoreElement.style.background = "linear-gradient(to right, #2a5298, #1e3c72)";
    } else if(score >= 80 && score < 90){
      scoreElement.style.background = "linear-gradient(to right, #7CC4FF, #9681FF)";
    } else if(score >= 90 && score < 95){
      scoreElement.style.background = "linear-gradient(45deg, #757575 0%, #9E9E9E 45%, #E8E8E8 70%, #9E9E9E 85%, #757575 90% 100%)";
    } else if(score >= 95 && score < 100){
      scoreElement.style.background = "linear-gradient(45deg, #B67B03 0%, #DAAF08 45%, #FEE9A0 70%, #DAAF08 85%, #B67B03 90% 100%)";
    } else if(score == 100){
      scoreElement.style.background = "linear-gradient(45deg, #B67B03 0%, #DAAF08 45%, #FEE9A0 70%, #DAAF08 85%, #B67B03 90% 100%)";
      scoreElement.classList.add('hundred');
    } else {
      scoreElement.style.background = "#555";
    }
  });
}

//==============================================================================
//====　end:関数宣言部 =======================================================

let scores = document.getElementsByClassName('video-score');
let otherScores = document.getElementsByClassName('other-video-score');
scores = Array.from(scores);
otherScores = Array.from(otherScores);
changeBackgroundColor(scores);
changeBackgroundColor(otherScores);



if (window.matchMedia('(max-width: 767px)').matches) {
  //ここに書いた処理はスマホの時だけ有効
  var elements = document.getElementsByClassName('other-video-title-a');
  elements = Array.from(elements);
  elements.forEach(element => {
    var text = element.innerText;
    element.innerText = cutString(text, 30);
  });
}
