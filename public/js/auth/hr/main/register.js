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
  changeString('description-content-1', '全国の学生の採点付き面接コンテンツを無料でご覧いただけます。<br>さらに、気になった学生にはオファーをすることが可能です。');
  changeString('description-content-2', '※成功報酬型（内定承諾時）の料金プランです。');

  planInput.value = "オファープラン";
}

hrButton.onclick = () => {
  hrButton.style.background = '#6B8BE9';
  hrButton.style.color = '#FFFFFF';

  offerButton.style.background = '#EEEEEE';
  offerButton.style.color = '#555555';

  changeString('description-title', '面接官プラン');
  changeString('description-content-1', '面接官ユーザーとして面接図鑑に参画していただくプランです。<br>全国の学生の面接を無料でご覧いただけます。');
  changeString('description-content-2', '※月額課金などは一切ございません。');

  planInput.value = "面接官プラン";
}
