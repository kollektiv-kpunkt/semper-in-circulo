if (document.querySelector(".sic-mitmachen-form-wrapper form")) {
  document
    .querySelectorAll(".sic-mitmachen-form-wrapper form")
    .forEach((form) => {
      form.addEventListener("submit", (e) => {
        let materialbutton = form.nextElementSibling.querySelector(
          ".sic-mitmachen-buttons a[href='/material-bestellen'"
        );
        let testimonialbutton = form.nextElementSibling.querySelector(
          ".sic-mitmachen-buttons a[href='/testimonial'"
        );
        let name = encodeURI(form.querySelector("input[name='name']").value);
        let email = encodeURI(form.querySelector("input[name='email']").value);
        materialbutton.href =
          "/material-bestellen?sic-fname=" + name + "&sic-email=" + email;
        testimonialbutton.href =
          "/testimonial?testi-name=" + name + "&testi-email=" + email;
      });
    });
}
