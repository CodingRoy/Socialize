var error = [];
var u = 0;
var e = 0;
var p = 0;

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

  function mail_val(){
    var error2 = document.getElementById("error2");
    var mail_l = document.forms["Register"]["email"].value.length;
    var email = document.forms["Register"]["email"].value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(mailformat.test(email)){
      error2.innerHTML = "";
      remove('1', e);
    }	else if (mail_l == 0) {
      error2.innerHTML = "This is a required field";
      error.push('1');
      e = e +1;
    } else {
      error2.innerHTML = "This email address is not valid";
      error.push('1');
      e = e +1;
    }
  }

  function pass_val() {
    var error3 = document.getElementById("error3");
    var un_l = document.forms["Register"]["password"].value.length;
    if (un_l == 0) {
      error3.innerHTML = "This is a required field";
      error.push('2');
      p = p +1;
    } else if (un_l < 3) {
      error3.innerHTML = "Min length of 3 characters, for your own safety";
      error.push('2');
      p = p +1;
    } else {
      error3.innerHTML = "";
      remove('2', p);
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
  mail_val();
  if(error.length > 0) {
    event.preventDefault();
  }
}
