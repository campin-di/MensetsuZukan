let elements = document.getElementsByClassName('inputGroup');
elements = Array.from(elements);

window.addEventListener('DOMContentLoaded', function(){
  elements.forEach(element => {
    element.style.display = 'none';
  });
});

let tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
let yyyy = tomorrow.getFullYear();
let mm = ("0"+(tomorrow.getMonth()+1)).slice(-2);
let dd = ("0"+tomorrow.getDate()).slice(-2);

let input_date = document.getElementById('date');
input_date.addEventListener("input", function(){
  let date = new Date(input_date.value);
  if(date <= tomorrow){
    alert("日程は明後日以降の日程を入力してください。")
    input_date.value=yyyy+'-'+mm+'-'+dd;
  }else{
    elements.forEach(element => {
      element.style.display = 'block';
    });
    
    let deleteDate = document.getElementById('delete-date');
    deleteDate.style.display = 'none';
  }
});

let checkboxs = document.getElementsByClassName('check');
checkboxs = Array.from(checkboxs);

let sumChecked;
checkboxs.forEach(checkbox => {
  checkbox.addEventListener("input", function(){
    sumChecked = 0;
    checkboxs.forEach(checkbox => {
      if(checkbox.checked === true) sumChecked += 1;
    });

    if(sumChecked > 0){
      checkboxs.forEach(checkbox => {
        checkbox.required = false;
      });
    }
  });
});


