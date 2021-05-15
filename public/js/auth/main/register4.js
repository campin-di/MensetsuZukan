const planInput = document.getElementById("plan");

const contributorButton = document.getElementById("contributor");
contributorButton.style.backgroundColor = '#6B8BE9';
contributorButton.style.color = '#FFFFFF';

const audienceButton = document.getElementById("audience");
audienceButton.style.color = '#555555';

//description-titleクラスの値を引数に変更
const changeString = ($class, $string) => {
  let elements = document.getElementsByClassName($class);
  elements = Array.from(elements) ;

  elements.forEach((eachText) => {
    eachText.innerHTML = $string;
  });
};

audienceButton.onclick = () => {
  contributorButton.style.background = '#EEEEEE';
  contributorButton.style.color = '#555555';

  audienceButton.style.background = '#6B8BE9';
  audienceButton.style.color = '#FFFFFF';

  changeString('description-title', '視聴者プラン');
  changeString('description-content-1', 'a全国の学生の面接を無料でご覧いただけます。<br>ただし、面接採点機能（無料）を<br>ご利用いただく必要があります。');
  changeString('description-content-2', '※3ヶ月以上面接採点機能のご利用がない場合、<br>自動的に面接動画が視聴不可となります。');

  planInput.value = "視聴者プラン";
}

contributorButton.onclick = () => {
  contributorButton.style.background = '#6B8BE9';
  contributorButton.style.color = '#FFFFFF';

  audienceButton.style.background = '#EEEEEE';
  audienceButton.style.color = '#555555';

  changeString('description-title', '投稿者プラン');
  changeString('description-content-1', '全国の学生の面接を無料でご覧いただけます。<br>ただし、面接採点機能（無料）を<br>ご利用いただく必要があります。');
  changeString('description-content-2', '※3ヶ月以上面接採点機能のご利用がない場合、<br>自動的に面接動画が視聴不可となります。');

  planInput.value = "投稿者プラン";
}
