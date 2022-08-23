import Cropper from "cropperjs";
import "cropperjs/dist/cropper.css";

import { toJpeg, toCanvas } from "html-to-image";

if (document.querySelector("#sic-testimonial-picture")) {
  document
    .querySelector("#sic-testimonial-picture")
    .addEventListener("change", function (e) {
      e.preventDefault();
      var imageFile = e.target.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(imageFile);
      reader.addEventListener("load", function () {
        let cropperImg = document.querySelector("#sic-testimonial-cropper");
        cropperImg.src = reader.result;
        document.querySelector(
          ".sic-testimonial-cropper-wrapper"
        ).style.display = "block";
        e.target.style.display = "none";
        const cropper = new Cropper(cropperImg, {
          aspectRatio: 46 / 57,
          autoCrop: true,
          autoCropArea: 1,
          viewMode: 1,
        });
        document
          .querySelector("#sic-testimonial-crop")
          .addEventListener("click", function (e) {
            e.preventDefault();
            var uuid =
              e.target.parentElement.parentElement.previousElementSibling.getAttribute(
                "data-uuid"
              );
            const croppedImage = cropper.getCroppedCanvas().toDataURL();
            var formData = {
              uuid: uuid,
              image: croppedImage,
            };
            (async () => {
              const response = await fetch("/api/v1/testimonial/2", {
                method: "POST",
                headers: {
                  // Accept: "application/json",
                  "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
              });
              const data = await response.json();
              prepareTestimonial(data.testimonial);
              document.querySelector(
                ".sic-testimonial-photo-step"
              ).style.display = "none";
            })();
          });
      });
    });
}

function prepareTestimonial(data) {
  var testiStage = document.querySelector(".sic-testimonial-stage");
  var testi = testiStage.querySelector(".sic-testimonial-inner");
  testi.querySelector("img").src = data.testi_img;
  testi.querySelector(".sic-testimonial-name").innerText = `${data.testi_name}`;
  if (data.testi_position != "") {
    testi.querySelector(
      ".sic-testimonial-position"
    ).innerText = `${data.testi_position}`;
  } else {
    testi.querySelector(".sic-testimonial-position").parentElement.remove();
  }
  testi.querySelector(
    ".sic-testimonial-quote"
  ).innerText = `${data.testi_quote}`;

  testiStage.style.display = "block";
}

if (document.querySelector(".testimonial-color")) {
  document.querySelectorAll(".testimonial-color").forEach(function (color) {
    color.addEventListener("click", function (e) {
      let color = e.target.getAttribute("data-color");
      let colorMain = `var(--${color})`;
      let color120 = `var(--${color}-120)`;
      let colorName = `var(--${color}-name)`;
      let colorPosition = `var(--${color}-positon)`;

      document
        .querySelectorAll(".sic-testimonial-arrows svg path")
        .forEach(function (arrow) {
          arrow.style.fill = colorMain;
        });

      document.querySelector(".sic-testimonial-cutout svg path").style.fill =
        color120;

      document.querySelector(".sic-testimonial-name").style.color = colorName;
      document.querySelector(".sic-testimonial-position").style.color =
        colorPosition;
    });
  });
}

if (document.querySelector(".sic-testimonial-download")) {
  document
    .querySelector(".sic-testimonial-download")
    .addEventListener("click", function (e) {
      e.preventDefault();
      var testimonial = document.querySelector(".sic-testimonial-inner");
      var name = document.querySelector(".sic-testimonial-name").innerText;
      var uuid = this.parentElement.parentElement
        .querySelector("form")
        .getAttribute("data-uuid");
      if (testimonial.classList.contains("fuckusafari")) {
        downloadSafari(testimonial, name, uuid);
      } else {
        downloadRegular(testimonial, name, uuid);
      }
    });
}

function downloadRegular(testimonial, name, uuid) {
  toJpeg(testimonial, {
    quality: 1,
    pixelRatio: 4,
  }).then(function (dataUrl) {
    var link = document.createElement("a");
    link.download = `KreislaufInitiative-testimonial-${name}-${uuid}.jpg`;
    link.href = dataUrl;
    link.click();
    link.remove();
  });
}

function downloadSafari(testimonial, name, uuid) {
  toCanvas(testimonial).then((canvas) => {
    const context = canvas.getContext("2d");
    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    let test = pixelsAreWhite(imageData);
    let attempts = 0;
    if (test) {
      setTimeout(() => {
        console.log(`Trying Safari rendering again...`);
        downloadSafari(testimonial, name, uuid);
        attempts++;
      }, 1000);
    } else {
      downloadRegular(testimonial, name, uuid);
    }
  });
}

function pixelsAreWhite(imageData) {
  let white = [];
  for (let i = 0; i < 60; i++) {
    white[i] = imageData.data[i] === 0;
  }
  console.log(white);
  return white.every(Boolean);
}
