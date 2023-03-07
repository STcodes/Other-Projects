const phone = document.getElementById("boutique-nav-phone");
const laptop = document.getElementById("boutique-nav-laptop");
const car = document.getElementById("boutique-nav-car");
const gadjets = document.getElementById("boutique-nav-gadjets");

const container_phone = document.getElementById("boutique-phone");
const container_laptop = document.getElementById("boutique-laptop");
const container_car = document.getElementById("boutique-car");
const container_gadjets = document.getElementById("boutique-gadjets");

phone.addEventListener("click", () => {
  phone.classList.add("boutique-nav-active");
  laptop.classList.remove("boutique-nav-active");
  car.classList.remove("boutique-nav-active");
  gadjets.classList.remove("boutique-nav-active");

  container_phone.classList.add("boutique-container-active");
  container_laptop.classList.remove("boutique-container-active");
  container_car.classList.remove("boutique-container-active");
  container_gadjets.classList.remove("boutique-container-active");
});

laptop.addEventListener("click", () => {
  phone.classList.remove("boutique-nav-active");
  laptop.classList.add("boutique-nav-active");
  car.classList.remove("boutique-nav-active");
  gadjets.classList.remove("boutique-nav-active");

  container_phone.classList.remove("boutique-container-active");
  container_laptop.classList.add("boutique-container-active");
  container_car.classList.remove("boutique-container-active");
  container_gadjets.classList.remove("boutique-container-active");
});

car.addEventListener("click", () => {
  phone.classList.remove("boutique-nav-active");
  laptop.classList.remove("boutique-nav-active");
  car.classList.add("boutique-nav-active");
  gadjets.classList.remove("boutique-nav-active");

  container_phone.classList.remove("boutique-container-active");
  container_laptop.classList.remove("boutique-container-active");
  container_car.classList.add("boutique-container-active");
  container_gadjets.classList.remove("boutique-container-active");
});

gadjets.addEventListener("click", () => {
  phone.classList.remove("boutique-nav-active");
  laptop.classList.remove("boutique-nav-active");
  car.classList.remove("boutique-nav-active");
  gadjets.classList.add("boutique-nav-active");

  container_phone.classList.remove("boutique-container-active");
  container_laptop.classList.remove("boutique-container-active");
  container_car.classList.remove("boutique-container-active");
  container_gadjets.classList.add("boutique-container-active");
});
