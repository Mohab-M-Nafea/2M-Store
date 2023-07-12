$('.dropdown-menu li').on('click', function() {
  var getValue = $(this).text();
  $('.dropdown-select').text(getValue);
  
  document.getElementById(id).innerHTML = getValue + "<i class='fa-solid fa-caret-down'></i>";

  var getId = $(this).attr("id");
  
  var input = document.getElementsByName(id);
  input[0].value =  getId;
  
});

const lists = document.getElementsByTagName("li");

const listPressed = e => { 
  id = e.target.id;
}

for (let list of lists) {
  list.addEventListener("click", listPressed);
}

var id;
const buttons = document.getElementsByTagName("button");

const buttonPressed = e => { 
  id = e.target.id;
}

for (let button of buttons) {
  button.addEventListener("click", buttonPressed);
}