if (document.querySelector(".sic-navbar-mobile-menu-button")) {
  document
    .querySelector(".sic-navbar-mobile-menu-button")
    .addEventListener("click", function () {
      document
        .querySelector(".sic-navbar-mobile-menu-container")
        .classList.toggle("menu-open");

      document
        .querySelector(".sic-navbar-mobile-menu-items")
        .classList.toggle("sic-navbar-mobile-menu-items-open");
    });

  document
    .querySelectorAll(
      ".sic-navbar-mobile-menu-items .menu-item-has-children > a"
    )
    .forEach(function (item) {
      item.addEventListener("click", function (e) {
        e.preventDefault();
        item.parentElement.classList.toggle("is-open");
      });
    });
}
