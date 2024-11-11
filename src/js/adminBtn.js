const menuBtn = document.getElementById("menuBtn");
const menuIcon = document.getElementById("menuIcon");
const menu = document.querySelector(".menu");
const closeBtn = document.getElementById("closeBtn");
let isMenuOpen = true;
menuBtn.addEventListener("click", () => {
  if (!isMenuOpen) {
    menu.style.display = "flex";
    isMenuOpen = !isMenuOpen;
    console.log(isMenuOpen, "1");
    menuIcon.classList.remove("fa-bars");
    menuIcon.classList.add("fa-xmark");
    menuBtn.style.backgroundColor = "#feb1b1";
  } else {
    menu.style.display = "none";
    isMenuOpen = !isMenuOpen;
    console.log(isMenuOpen, "2");
    menuIcon.classList.remove("fa-xmark");
    menuIcon.classList.add("fa-bars");
    menuBtn.style.backgroundColor = "#fff";
  }
});
