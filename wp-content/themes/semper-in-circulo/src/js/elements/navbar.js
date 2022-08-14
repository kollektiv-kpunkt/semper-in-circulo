if (document.querySelector(".sic-navbar-mobile-menu-button")) {
  document
    .querySelector(".sic-navbar-mobile-menu-button")
    .addEventListener("click", function () {
      console.log("uwu");
      document
        .querySelector(".sic-navbar-mobile-menu-container")
        .classList.toggle("menu-open");

      document
        .querySelector(".sic-navbar-mobile-menu-items")
        .classList.toggle("sic-navbar-mobile-menu-items-open");
    });
}
