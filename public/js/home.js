let elements = document.getElementsByClassName("question-selected");
elements = Array.from(elements);

//クリックしたタグのコンテンツだけを表示する関数
const displayNoneElement = (question) => {
  elements.forEach(element => {
    if(question === "ALL"){
      //ALLが選択されたときは、クラス名"content-box"を全て表示
      contents = document.getElementsByClassName("content-box");
      for(i=0;i<contents.length;i++){
        contents[i].style.display ="block";
      }
    } else{
      if(element.innerHTML !== question){
        element.closest(".content-box").style.display ="none";
      } else {
        element.closest(".content-box").style.display ="block";
      }
    }
  });
}

//クリックしたタグの背景色を変更する関数
const changeBackgroundColorElement = (id) =>{
  for( let index = 1; index <= questions.length; index++){
    if(id === 0){
      document.getElementById("button-all").style.backgroundColor = '#0245CC';
    } else {
      document.getElementById("button-all").style.backgroundColor = '#D5E3FF';
    }
    if(id === index){
      document.getElementById("button-" + index).style.backgroundColor = '#0245CC';
    } else {
      document.getElementById("button-" + index).style.backgroundColor = '#D5E3FF';
    }
  }
}

for( let index = 1; index <= questions.length; index++){
  document.getElementById("button-" + index).onclick = function() {
    displayNoneElement(document.getElementById("text-" + index).innerHTML);
    changeBackgroundColorElement(index);
  };
}

//「ALL」が押されたとき
document.getElementById("button-all").onclick = function() {
  displayNoneElement(document.getElementById("text-all").innerHTML);
  changeBackgroundColorElement(0);
};

//最初だけ「自己紹介をお願いします。」を押している状態にする。
document.getElementById("button-all").click();
