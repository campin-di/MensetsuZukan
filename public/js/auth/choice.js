const stUrl = document.getElementById("url_st");
stUrl.style.display ="block";

const hrUrl = document.getElementById("url_hr");
hrUrl.style.display ="none";


const stButton = document.getElementById("st");
stButton.style.backgroundColor = '#6666FF';

const hrButton = document.getElementById("hr");

//descriptionクラスの値を引数に変更
const changeString = ($string) => {
  let elements = document.getElementsByClassName('description');
  elements = Array.from(elements) ;

  elements.forEach((eachText) => {
    eachText.innerText = $string;
  });
};

hrButton.onclick = () => {
  stUrl.style.display ="none";
  hrUrl.style.display ="block";

  stButton.style.backgroundColor = '#EEEEEE';
  hrButton.style.backgroundColor = '#6666FF';

  changeString('人事');
}

stButton.onclick = () => {
  stUrl.style.display ="block";
  hrUrl.style.display ="none";

  stButton.style.backgroundColor = '#6666FF';
  hrButton.style.backgroundColor = '#EEEEEE';

  changeString('学生');
}
