let elements = document.getElementsByClassName('video-wrapper');
elements = Array.from(elements);


tmp2 = elements[0].children[0].children[1].children[1].children[0];
tmp = elements[0].children[0].children[1].children[3].children[0].children[1].innerText;

console.log(tmp);

/*
elements.forEach(element => {
  tmp3 = element.children[0].children[1].children[1].children[0].innerText.trim();
  console.log(tmp3);
});
*/

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

//全コンテンツを非表示にする関数
const displayNoneElement = () => {
  elements.forEach(element => {
    element.closest(".video-wrapper").style.display = "none";
  });
}

//全コンテンツを表示にする関数
const displayAllElement = () => {
  elements.forEach(element => {
    element.closest(".video-wrapper").style.display = "block";
  });
}

//selectで選択した値に該当するコンテンツを表示
const displayElement = ($question, $prefecture, $postedDate) => {
  elements.forEach(element => {
    targetQuestion = element.children[0].children[1].children[1].children[0].innerText.trim();
    targetScore = parseInt(element.children[0].children[1].children[3].children[1].children[0].innerText.trim());
    targetDate = element.children[0].children[1].children[3].children[0].children[1].innerText;

    if((targetQuestion !== $question) && ($question !== 'null')){
      element.closest(".video-wrapper").style.display = "none";
    }

    if($prefecture !== 'null'){
      $prefecture = parseInt($prefecture);

      if($prefecture === 100){
        if(targetScore !== 100){
          element.closest(".video-wrapper").style.display = "none";
        }
      }
      else if($prefecture === 70){
        if(!between(targetScore, 60, 69)){
          element.closest(".video-wrapper").style.display = "none";
        }
      }
      else if(!between(targetScore, $prefecture, $prefecture+4)){
          element.closest(".video-wrapper").style.display = "none";
      }
    }

    // $postedDateがselectの値
    //dateClassficationがコンテンツの日・週・ヶ月などの区分
    //dateNumberが区分の中で、数字がいくつか
    //（3ヶ月前だと、dateClassfication == m, dateNumber == 3）
    if($postedDate !== 'null'){
      dateClassfication = retDateClassification(targetDate);
      dateNumber = parseInt(targetDate.charAt(0));
      switch (dateClassfication) {
        case 'd':
        break;
        case 'w':
        if($postedDate === '1-w'){
          if(dateNumber > 1){
            element.closest(".video-wrapper").style.display = "none";
          }
        }
        break;
        case 'm':
        if($postedDate === '1-w'){
          element.closest(".video-wrapper").style.display = "none";
          break;
        } else if($postedDate === '1-y'){
          break;
        } else{
          if($postedDate === '1-m'){
            if(dateNumber > 1){
              element.closest(".video-wrapper").style.display = "none";
            }
          } else if($postedDate === '3-m'){
            if(dateNumber > 3){
              element.closest(".video-wrapper").style.display = "none";
            }
          } else if($postedDate === '6-m'){
            if(dateNumber > 6){
              element.closest(".video-wrapper").style.display = "none";
            }
          }
          break;
        }
        case 'y':
        if(($postedDate === '1-w') || ($postedDate === '1-m') || ($postedDate === '3-m') || ($postedDate === '6-m')){
          element.closest(".video-wrapper").style.display = "none";
        } else if($postedDate === '1-y'){
          if(dateNumber > 1){
            element.closest(".video-wrapper").style.display = "none";
          }
        }
        break;
        default:
      }
    }
  });
}


let questionSelect = document.getElementById('question');
let prefectureSelect = document.getElementById('prefecture');
let postedDateSelect = document.getElementById('postedDate');

//selectの値が変わったときに動作する関数
const onchange = () => {
  displayAllElement();

  let question = questionSelect.value.trim();
  let prefecture = prefectureSelect.value.trim();
  let postedDate = postedDateSelect.value.trim();

  if(question === '全質問'){
    question = 'null';
  }
  if(prefecture === '全得点'){
    prefecture = 'null';
  }
  if(postedDate === '全投稿日'){
    postedDate = 'null';
  }

  displayElement(question, prefecture, postedDate);
}

const ids = ['question', 'prefecture', 'postedDate'];
ids.forEach(id => {
  document.getElementById(id).onchange = function(){
    onchange();
  }
});
