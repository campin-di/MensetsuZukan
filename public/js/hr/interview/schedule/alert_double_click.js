let submit = document.getElementById('button');

submit.onclick = () => {
    confirm('面接会場となるzoomリンクを発行します。ページが切り替わるまでしばらくお待ちください。');
    setTimeout( disabled(button) , 5000);
    setTimeout(() => {
        button.disabled = false;
        button.style.background = "linear-gradient(to right, #7CC4FF, #7F66FF)";
    }, 20000);
}