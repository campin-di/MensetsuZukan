let button = document.getElementById('button');
button.onclick = () => {
    setTimeout( disabled(button) , 5000);
    setTimeout(() => {
        button.disabled = false;
        button.style.background = "linear-gradient(to right, #7CC4FF, #7F66FF)";
    }, 5000);
}

const disabled = ($target) => {
    $target.style.background = "#AAA";
    setTimeout(() => {
        $target.disabled = true;
    }, 50);
}