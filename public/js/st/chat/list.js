//（SPのみ）文字数カット
const cutString = ($text, $length) => {
    //textが20文字より多い場合は、前者が返され、少ない場合は後者が返される。
    var slicetext = $text.length > $length ? ($text).slice(0, $length)+"…" : $text;
    return slicetext;
}

const selectCutElement = ($class, $length) => {
    if (window.matchMedia('(max-width: 767px)').matches) {
      //ここに書いた処理はスマホの時だけ有効
      let strings = document.getElementsByClassName($class);
      strings = Array.from(strings);
      strings.forEach(string => {
        let text = string.innerText.trim();
        string.innerText = cutString(text, $length);
      });
    }
}

selectCutElement('chat-body', 40);