const planInput = document.getElementById("plan");

const hrButton = document.getElementById("hr");
hrButton.style.backgroundColor = '#6B8BE9';
hrButton.style.color = '#FFFFFF';

const offerButton = document.getElementById("offer");
offerButton.style.color = '#555555';

//description-titleクラスの値を引数に変更
const changeString = ($class, $string) => {
  let elements = document.getElementsByClassName($class);
  elements = Array.from(elements) ;

  elements.forEach((eachText) => {
    eachText.innerHTML = $string;
  });
};

offerButton.onclick = () => {
  hrButton.style.background = '#EEEEEE';
  hrButton.style.color = '#555555';

  offerButton.style.background = '#6B8BE9';
  offerButton.style.color = '#FFFFFF';

  changeString('description-title', 'オファープラン');
  changeString('description-content-1', 'a全国の学生の面接を無料でご覧いただけます。<br>ただし、面接採点機能（無料）を<br>ご利用いただく必要があります。');
  changeString('description-content-2', '※3ヶ月以上面接採点機能のご利用がない場合、<br>自動的に面接動画が視聴不可となります。');

  planInput.value = "オファープラン";
}

hrButton.onclick = () => {
  hrButton.style.background = '#6B8BE9';
  hrButton.style.color = '#FFFFFF';

  offerButton.style.background = '#EEEEEE';
  offerButton.style.color = '#555555';

  changeString('description-title', '面接官プラン');
  changeString('description-content-1', '全国の学生の面接を無料でご覧いただけます。<br>ただし、面接採点機能（無料）を<br>ご利用いただく必要があります。');
  changeString('description-content-2', '※3ヶ月以上面接採点機能のご利用がない場合、<br>自動的に面接動画が視聴不可となります。');

  planInput.value = "面接官プラン";
}
