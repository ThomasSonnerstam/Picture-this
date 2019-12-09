"use strict";

// When you click the header logo you're redirected to the homepage
const logo = document.querySelector("nav img");

logo.addEventListener("click", () => {
  window.location.href = "/";
});
