let elements = document.getElementsByClassName('inputGroup');
elements = Array.from(elements);

window.addEventListener('DOMContentLoaded', function(){
  elements.forEach(element => {
    element.style.display = 'none';
  });
});

let input_date = document.getElementById('date');
input_date.addEventListener("input", function(){
  elements.forEach(element => {
    element.style.display = 'block';
  });
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
