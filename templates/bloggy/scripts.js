function getBack(){
  history.go(-1);
  return false;
}

function redirect(path) {
  window.location = path;
}