// index

const items = document.querySelectorAll(".index-slider-image");
const items1 = document.querySelectorAll(".index-slider-image1");
const items2 = document.querySelectorAll(".index-slider-image2");
const nbSlide = items.length;
const suivant = document.querySelector(".right");
const precedent = document.querySelector(".left");
let count = 0;

function slideSuivante() {
  items[count].classList.remove("index-slider-active");
  items1[count].classList.remove("index-slider-active");
  items2[count].classList.remove("index-slider-active");

  if (count < nbSlide - 1) {
    count++;
  } else {
    count = 0;
  }

  items[count].classList.add("index-slider-active");
  items1[count].classList.add("index-slider-active");
  items2[count].classList.add("index-slider-active");
}
suivant.addEventListener("click", slideSuivante);

function slidePrecedente() {
  items[count].classList.remove("index-slider-active");
  items1[count].classList.remove("index-slider-active");
  items2[count].classList.remove("index-slider-active");

  if (count > 0) {
    count--;
  } else {
    count = nbSlide - 1;
  }

  items[count].classList.add("index-slider-active");
  items1[count].classList.add("index-slider-active");
  items2[count].classList.add("index-slider-active");
}
precedent.addEventListener("click", slidePrecedente);

setInterval(slideSuivante, 3000);

const index_count = document.querySelectorAll(".index-cnt");
let j = 0;
window.addEventListener("scroll", () => {
  if (window.scrollY > 556) {
    if (j == 0) {
      index_count.forEach((box) => {
        console.log("salut");
        let a = box.textContent;
        let i = 0;
        setInterval(() => {
          if (i <= a) {
            box.textContent = "";
            box.textContent = i;
            console.log(box.textContent);
            i++;
          }
        }, 80);
      });
      j = 1;
    }
  }
});
