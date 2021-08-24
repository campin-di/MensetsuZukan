let submit = document.getElementById('button');

submit.onclick = () => {
    confirm('面接日程を登録します。「OK」をクリックし、ページが切り替わるまでしばらくお待ちください。');
    setTimeout( disabled(button) , 5000);
    setTimeout(() => {
        button.disabled = false;
        button.style.background = "linear-gradient(to right, #7CC4FF, #7F66FF)";
    }, 20000);
}