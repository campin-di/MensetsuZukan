const stUrl = document.getElementById("url_st");
stUrl.style.display ="block";

const hrUrl = document.getElementById("url_hr");
hrUrl.style.display ="none";

const stLogin = document.getElementById("login_st");
stLogin.style.display ="block";

const hrLogin = document.getElementById("login_hr");
hrLogin.style.display ="none";


const stButton = document.getElementById("st");
stButton.style.backgroundColor = '#6B8BE9';
stButton.style.color = '#FFFFFF';

const hrButton = document.getElementById("hr");
hrButton.style.color = '#555555';

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

  stLogin.style.display ="none";
  hrLogin.style.display ="block";


  stButton.style.background = '#EEEEEE';
  stButton.style.color = '#555555';

  hrButton.style.background = '#6B8BE9';
  hrButton.style.color = '#FFFFFF';

  changeString('人事');
}

stButton.onclick = () => {
  stUrl.style.display ="block";
  hrUrl.style.display ="none";

  stLogin.style.display ="block";
  hrLogin.style.display ="none";

  stButton.style.background = '#6B8BE9';
  stButton.style.color = '#FFFFFF';

  hrButton.style.background = '#EEEEEE';
  hrButton.style.color = '#555555';

  changeString('学生');
}
