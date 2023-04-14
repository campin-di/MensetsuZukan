const fixedButton = document.getElementById('login-wrapper').children[1].children[1];
fixedButton.id = 'login';

const urlElement = document.getElementById("url");
urlElement.style.display ="block";

const loginElement = document.getElementById("login");
loginElement.style.display ="block";

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

//URLを変更する関数
changeUrl = ($href, $before, $after) => {
  $href = $href.replace($before, $after);

  return $href;
}

hrButton.onclick = () => {
  urlElement.href = changeUrl(urlElement.href, '/register', '/hr/register');
  loginElement.href = changeUrl(loginElement.href, '/login', '/hr/login');

  stButton.style.background = '#EEEEEE';
  stButton.style.color = '#555555';

  hrButton.style.background = '#6B8BE9';
  hrButton.style.color = '#FFFFFF';

  changeString('人事');
}

stButton.onclick = () => {
  urlElement.href = changeUrl(urlElement.href, '/hr/register', '/register');
  loginElement.href = changeUrl(loginElement.href, '/hr/login', '/login');

  stButton.style.background = '#6B8BE9';
  stButton.style.color = '#FFFFFF';

  hrButton.style.background = '#EEEEEE';
  hrButton.style.color = '#555555';

  changeString('学生');
}
