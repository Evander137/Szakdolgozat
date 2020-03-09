function $(id) {
  return document.getElementById(id);
}

$("regisztracio").addEventListener("click", function(){
  window.open("pages/Regisztracio.html", "_self");
})