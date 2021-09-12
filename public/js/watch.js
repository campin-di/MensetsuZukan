//textが20文字より多い場合は、前者が返され、少ない場合は後者が返される。
const cutString = ($text, $length) => {
  let slicetext = $text.length > $length ? ($text).slice(0, $length)+"…" : $text;

  return slicetext;
}

//得点の背景色を変更する関数
const changeBackgroundColor = ($scores) => {
  $scores.forEach(scoreElement => {
    console.log(scoreElement);
    let score = scoreElement.children[1].innerText;

    if(score >= 60 && score < 70){
      scoreElement.style.background = "linear-gradient(360deg, #537895, #09203f)";
    } else if(score >= 70 && score < 80){
      scoreElement.style.background = "linear-gradient(360deg, #8ec5fc, #e0c3fc)";
    } else if(score >= 80 && score < 90){
      scoreElement.style.background = "linear-gradient(360deg, #7CC4FF, #9681FF)";
    } else if(score >= 90 && score < 95){
      scoreElement.style.background = "linear-gradient(360deg, #fee140, #fa709a)";
    } else if(score >= 95 && score < 100){
      scoreElement.style.background = "linear-gradient(45deg, #fee140 0%, #fee140 45%, #FEE9A0 70%, #DAAF08 85%, #B67B03 90% 100%)";
    } else if(score == 100){
      scoreElement.style.background = "linear-gradient(45deg, #fee140 0%, #fee140 45%, #FEE9A0 70%, #DAAF08 85%, #B67B03 90% 100%)";
      scoreElement.classList.add('hundred');
    } else {
      scoreElement.style.background = "#555";
    }
  });
}

//==============================================================================
//====　end:関数宣言部 =======================================================

let scores = document.getElementsByClassName('total-score-wrapper');
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

document.getElementById('public_button').onclick = function() {
  window.alert('「公開設定：人事のみ」にすると企業からのオファー率が下がってしまうのでご注意ください。');
};

$('#total').on('inview', function(event, isInView) {
  if (isInView) {
    //要素が見えたときに実行する処理
    $("#total .count-up").each(function(){
      $(this).prop('Counter',0).animate({ //0からカウントアップ
            Counter: $(this).text()
        }, {
        // スピードやアニメーションの設定
            duration: 3000,//数字が大きいほど変化のスピードが遅くなる。2000=2秒
            easing: 'swing',//動きの種類。他にもlinearなど設定可能
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
  }
});

$('#each').on('inview', function(event, isInView) {
  if (isInView) {
    //要素が見えたときに実行する処理
    $("#each .count-up").each(function(){
      $(this).prop('Counter',0).animate({//0からカウントアップ
            Counter: $(this).text()
        }, {
        // スピードやアニメーションの設定
            duration: 1000,//数字が大きいほど変化のスピードが遅くなる。2000=2秒
            easing: 'swing',//動きの種類。他にもlinearなど設定可能
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
  }
});