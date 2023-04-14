//selectが変更されたときのみ実行される。
schedules.forEach(schedule => {
  document.getElementById(schedule.date).onchange = function(){
    colorChanger(schedule.date);
  }
});

none = document.getElementById('none');
none.onchange = function(){
  none.style.background = '#6B8BE9';

  schedules.forEach(schedule => {
    colorChanger(none);
  });
}

const colorChanger = ($id) =>{
  schedules.forEach(schedule => {
    if(schedule.date !== $id){
      scheduleElement = document.getElementById(schedule.date);
      scheduleElement.options[0].selected = true;
      scheduleElement.required = false;

      scheduleElement.style.color = '#CCC';
      scheduleElement.style.background = '#FFF';
      scheduleElement.style.fontWeight = 'initial';
    }
  });

  if($id !== none){
    none.options[0].selected = true;
    none.required = false;

    none.style.color = '#CCC';
    none.style.background = '#FFF';
    none.style.fontWeight = 'initial';

    selectedElement = document.getElementById($id);
    selectedElement.style.color = '#FFF';
    selectedElement.style.fontWeight = 'bold';
    selectedElement.style.background = '#6B8BE9';
  } else {
    none.style.color = '#FFF';
    none.style.fontWeight = 'bold';
    none.style.background = '#6B8BE9';
  }
}
