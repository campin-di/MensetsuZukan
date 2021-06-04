
const onclickChanger = ($id, $inputId, $placeholder) => {
  document.getElementById($id).onclick = () => {
    input = document.getElementById($inputId);
    input.placeholder = $placeholder;
    input.disabled = false;
    input.required = true;

    document.getElementsByClassName('next-button')[0].style.display = "block";
  }
}

onclickChanger('edit_password', 'password', '8文字以上でパスワードを入力してください。');
