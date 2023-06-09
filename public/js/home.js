let elements = document.getElementsByClassName('video-wrapper');
elements = Array.from(elements);

//====　begin:関数宣言部 =======================================================
//==============================================================================

//xがmin以上max以下かを判定する関数
function between(x, min, max) {
  return x >= min && x <= max;
}

//投稿日の週・月・年の区分を返す関数
const retDateClassification = ($targetDate) =>{
  if($targetDate.indexOf('日') !== -1){
    return 'd';
  } else if($targetDate.indexOf('週') !== -1){
    return 'w';
  } else if($targetDate.indexOf('月') !== -1){
    return 'm';
  } else if($targetDate.indexOf('年') !== -1){
    return 'y';
  } else {
    return 'null';
  }
}

//指定なしかどうかを判断して、指定なしの場合'null'を返す関数
const isSelect = ($target) => {
  if($target === '指定なし'){
    return 'null';
  }
  return $target;
}

//閾値と、コンテンツの投稿日の数値を与えて、コンテンツを非表示にする関数
const hideElement = ($element, $dateNumber, $border) => {
  if($dateNumber > $border){
    $element.closest(".video-wrapper").style.display = "none";
  }
}

//全コンテンツを表示にする関数
const displayAllElement = () => {
  elements.forEach(element => {
    element.closest(".video-wrapper").style.display = "block";
  });
}

//質問によって、コンテンツを非表示にする関数
const hideAboutQuestion = ($element, $targetQuestions, $question) => {
  flag = false;
  $targetQuestions.forEach($targetQuestion => {
    if($targetQuestion == $question || $question == 'null'){
      flag = true;
    }
  });

  if(flag === false){
    $element.closest(".video-wrapper").style.display = "none";
  }
}

//スコアの区分によって、コンテンツを非表示にする関数
const hideAboutScore = ($element, $targetScore, $score) => {
  if($score !== 'null'){
    $score = parseInt($score);

    if($score === 100){
      if($targetScore < 100){
        $element.closest(".video-wrapper").style.display = "none";
      }
    }
    else if($score === 60){
      if(!between($targetScore, 60, 69)){
        $element.closest(".video-wrapper").style.display = "none";
      }
    }
    else if(!between($targetScore, $score, $score+9)){
        $element.closest(".video-wrapper").style.display = "none";
    }
  }
}

//投稿日の区分によって、コンテンツを非表示にする関数
const hideAboutPostedDate = ($element, $targetDate, $postedDate) => {
  // $postedDateがselectの値
  //dateClassficationがコンテンツの日・週・ヶ月などの区分
  //dateNumberが区分の中で、数字がいくつか
  //（3ヶ月前だと、dateClassfication == m, dateNumber == 3）
  if($postedDate !== 'null'){
    dateClassfication = retDateClassification($targetDate);
    dateNumber = parseInt($targetDate.charAt(0));
    switch (dateClassfication) {
      case 'w':
        if($postedDate === '1-w'){
          hideElement($element, dateNumber, 1);
        }
        break;
      case 'm':
        if($postedDate === '1-w'){
          $element.closest(".video-wrapper").style.display = "none";
          break;
        } else{
          if($postedDate === '1-m'){
            hideElement($element, dateNumber, 1);
          } else if($postedDate === '3-m'){
            hideElement($element, dateNumber, 3);
          } else if($postedDate === '6-m'){
            hideElement($element, dateNumber, 6);
          }
          break;
        }
      case 'y':
        if(($postedDate === '1-w') || ($postedDate === '1-m') || ($postedDate === '3-m') || ($postedDate === '6-m')){
          $element.closest(".video-wrapper").style.display = "none";
        } else if($postedDate === '1-y'){
          hideElement($element, dateNumber, 1);
        }
        break;
      default:
    }
  }
}

//selectで選択した値に該当しないコンテンツを非表示
const displayElement = ($question, $score, $postedDate) => {
  elements.forEach(element => {
    //targetQuestion = element.getElementsByClassName('other-question-selected')[0].innerText;
    targetQuestionObjects = element.getElementsByClassName('other-question-selected');
    targetQuestionObjects = Array.from(targetQuestionObjects);

    targetQuestions = [];
    targetQuestionObjects.forEach(targetQuestionObject => {
      //console.log(targetQuestionObject.innerText);
      targetQuestions.push(targetQuestionObject.innerText);
    });
    console.log(targetQuestions);
    
    targetScore = element.getElementsByClassName('video-score')[0].children[0].innerText;
    targetDate = element.getElementsByClassName('date')[0].innerText;

    hideAboutQuestion(element, targetQuestions, $question);
    hideAboutScore(element, targetScore, $score);
    hideAboutPostedDate(element, targetDate, $postedDate);
  });
}

//selectの値が変わったときに動作する関数
const onchange = ($question, $score, $date) => {
  displayAllElement();
  displayElement(isSelect($question.value), isSelect($score.value), isSelect($date.value));
}

//得点の背景色を変更する関数
const changeBackgroundColor = ($scores) => {
  $scores.forEach(scoreElement => {
    let score = scoreElement.children[0].innerText;
    
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
let scores = document.getElementsByClassName('video-score');
scores = Array.from(scores);
changeBackgroundColor(scores);

let questionSelect = document.getElementById('question');
let scoreSelect = document.getElementById('score');
let postedDateSelect = document.getElementById('postedDate');

const ids = ['question', 'score', 'postedDate'];
ids.forEach(id => {
  document.getElementById(id).onchange = function(){
    onchange(questionSelect, scoreSelect, postedDateSelect);
  }
});
