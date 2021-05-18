

//selectが変更されたときのみ実行される。
schedules.forEach(schedule => {
  document.getElementById(schedule.date).onchange = function(){
    console.log('Hello');
    colorChanger(schedule.date);
  }
});

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
  selectedElement = document.getElementById($id);
  selectedElement.style.color = '#FFF';
  selectedElement.style.fontWeight = 'bold';
  selectedElement.style.background = '#6B8BE9';
}
