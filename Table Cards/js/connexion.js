function myfunction() {
  let x = document.getElementById("pass");
  let y = document.getElementById("hide1");

  if (x.type === "password") {
    x.type = "text";
    y.classList.remove("fa-eye-slash");
    y.classList.add("fa-eye");
  } else {
    x.type = "password";
    y.classList.remove("fa-eye");
    y.classList.add("fa-eye-slash");
  }
}
