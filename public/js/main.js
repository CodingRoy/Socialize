function confirmation(id) {
  var confirm = document.getElementById("confirmation"+id);
  confirm.style.display = "block";
  document.getElementById("no").onclick = function() {
    confirm.style.display = "none";
  }
}

function checkSubmit(e) {
   if(e && e.keyCode == 13 && ! e.shiftKey) {
      document.forms[0].submit();
   }
}
