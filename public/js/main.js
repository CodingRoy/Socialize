function confirmation(id) {
  var confirm = document.getElementById("confirmation"+id);
  confirm.style.display = "block";
  document.getElementById("no").onclick = function() {
    confirm.style.display = "none";
  }
}
