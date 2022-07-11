let elements = document.getElementsByClassName('company-information-wrapper');
elements = Array.from(elements);

//全コンテンツを非表示にする関数
const displayNoneElement = () => {
  elements.forEach(element => {
    element.closest(".hr-profile-wrapper").style.display = "none";
  });
}

//全コンテンツを表示にする関数
const displayAllElement = () => {
  elements.forEach(element => {
    element.closest(".hr-profile-wrapper").style.display = "block";
  });
}

//selectで選択した値に該当するコンテンツを表示
const displayElement = ($industry, $prefecture, $stockType) => {
  elements.forEach(element => {
    if(element.children[0].innerText.trim() !== $industry && $industry !== 'null'){
      element.closest(".hr-profile-wrapper").style.display = "none";
    }
    if(element.children[1].innerText.trim() !== $prefecture && $prefecture !== 'null'){
      element.closest(".hr-profile-wrapper").style.display = "none";
    }
    if(element.children[2].innerText.trim() !== $stockType && $stockType !== 'null'){
      element.closest(".hr-profile-wrapper").style.display = "none";
    }
  });
}

// let industrySelect = document.getElementById('industry');
let prefectureSelect = document.getElementById('prefecture');
let stockTypeSelect = document.getElementById('stockType');

//selectの値が変わったときに動作する関数
const onchange = () => {
  displayNoneElement();

  // let industry = industrySelect.value.trim();
  let industry = '全業界';
  let prefecture = prefectureSelect.value.trim();
  let stockType = stockTypeSelect.value.trim();

  if(industry === '全業界'){
    displayAllElement();
    industry = 'null';
  }
  if(prefecture === '全国'){
    displayAllElement();
    prefecture = 'null';
  }
  if(stockType === '全区分'){
    displayAllElement();
    stockType = 'null';
  }

  displayElement(industry, prefecture, stockType);
}

// document.getElementById('industry').onchange = function(){
//   onchange();
// }
document.getElementById('prefecture').onchange = function(){
  onchange();
}
document.getElementById('stockType').onchange = function(){
  onchange();
}

//（SPのみ）文字数カット
const cutString = ($text, $length) => {
  //textが20文字より多い場合は、前者が返され、少ない場合は後者が返される。
  var slicetext = $text.length > $length ? ($text).slice(0, $length)+"…" : $text;
  return slicetext;
}

const selectCutElement = ($class, $length) => {
  if (window.matchMedia('(max-width: 767px)').matches) {
    //ここに書いた処理はスマホの時だけ有効
    let strings = document.getElementsByClassName($class);
    strings = Array.from(strings);
    strings.forEach(string => {
      let text = string.innerText;
      string.innerText = cutString(text, $length);
    });
  }
}

selectCutElement('company-information', 7);
selectCutElement('pr-message', 40);
