channel = document.getElementById('channel');
inputSupplement = document.getElementById('supplement');

const supplementArray = ['知人/運営からの紹介', '所属組織/団体', 'その他'];

channel.onchange = function(){
  if(supplementArray.includes(channel.value)){
    if(channel.value == '知人/運営からの紹介'){
      inputSupplement.placeholder = '例：吉田裕哉';
    }else if(channel.value == '所属組織/団体'){
      inputSupplement.placeholder = '例：面接図鑑キャリア';
    }else{
      inputSupplement.placeholder = '例：ネット検索・広告';
    }
    inputSupplement.required = true;

    inputSupplement.style.display = "block";
  }else{
    inputSupplement.required = false;
    inputSupplement.style.display = "none";
  }
}