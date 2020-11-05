const p = document.getElementById("exampleInputPassword1");
const c = document.getElementById("exampleInputPassword2");
const sma = document.getElementById("emailHelp");
const btn = document.getElementById("submit");
eve();
function eve() {
  c.addEventListener("keyup", check);
}
function check() {
  let pv = p.value;
  let cv = c.value;
  if (pv === cv) {
    sma.style.color = "green";
    sma.innerText = "Password matching";
    btn.disabled = false;
  } else {
    sma.style.color = "red";
    sma.innerText = "password is not matching";
    btn.disabled = true;
  }
}
