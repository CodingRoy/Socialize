function confirmation(id) {
  var confirm = document.getElementById("confirmation"+id);
  confirm.style.display = "block";
  document.getElementById("no"+id).onclick = function() {
    confirm.style.display = "none";
  }
}

function checkSubmit(e) {
   if(e && e.keyCode == 13 && ! e.shiftKey) {
      document.forms[0].submit();
   }
}

function menu() {
  var item = document.getElementsByClassName("item")
  var i = 0;
  while (item[i]) {
    if (item[i].style.display !== 'none') {
        item[i].style.display = 'none';
    } else {
        item[i].style.display = 'block';
    }
    i++;
  }
};
