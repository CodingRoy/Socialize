var error = [];
var u = 0;

function un_val() {
  var error1 = document.getElementById("error1");
  var un = document.forms["Register"]["username"].value;
  var un_l = document.forms["Register"]["username"].value.length;
  var format = /^[0-9a-zA-Z,_-]+$/;
  if (un_l == 0) {
    error1.innerHTML = "This is a required field";
    error.push('0');
    u = u +1;
  } else if (un_l < 3 || un_l > 29) {
    error1.innerHTML = "Min length of 3 characters, max length of 29 characters";
    error.push('0');
    u = u +1;
  } else if (!format.test(un)) {
    error1.innerHTML = "Can only contain letters, numbers and underscore _ or dash -.";
    error.push('0');
    u = u +1;
  } else {
    error1.innerHTML = "";
    remove('0', u);
  }
}

function remove(x, y){
  var i = error.indexOf(x);
  if (i >= 0){
    error.sort();
    error.splice(i, y);
  }
}

function val() {
  un_val();
  if(error.length > 0) {
    event.preventDefault();
  }
}
