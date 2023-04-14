const OnLinkClick = () => {
  target = document.getElementById("copy");

  let templete = document.getElementById("templete");

  let range = document.createRange();
  range.selectNodeContents(templete);

  let selection = window.getSelection();
  selection.removeAllRanges();
  selection.addRange(range);
  // 選択したものをコピーする.
  document.execCommand('copy');

  selection.removeAllRanges();

  alert("コピーしました！");   
  return false;
}