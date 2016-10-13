function confirmation() {
  var confirm = document.getElementById("confirmation");
  confirm.style.display = "block";
  document.getElementById("no").onclick = function() {
    confirm.style.display = "none";
  }
}
