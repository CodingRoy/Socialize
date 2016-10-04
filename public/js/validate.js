var error = [];
var u = 0;

function un_val() {
  var error1 = document.getElementById("error1");
  var un_l = document.forms["Register"]["username"].value.length;
  if (un_l == 0) {
    error.push('0');
    error1.innerHTML = "This is a required field" + error;
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
