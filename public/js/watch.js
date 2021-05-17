const cutString = ($text, $length) => {
  //textが20文字より多い場合は、前者が返され、少ない場合は後者が返される。
  var slicetext = $text.length > $length ? ($text).slice(0, $length)+"…" : $text;

  return slicetext;
}

if (window.matchMedia('(max-width: 767px)').matches) {
  //ここに書いた処理はスマホの時だけ有効
  var elements = document.getElementsByClassName('other-video-title-a');
  elements = Array.from(elements);
  elements.forEach(element => {
    var text = element.innerText;
    element.innerText = cutString(text, 30);
  });
}
