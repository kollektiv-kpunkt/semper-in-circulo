import { v4 as uuid } from "uuid";

if (document.querySelector(".sic-api-form")) {
  document.querySelectorAll(".sic-api-form").forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var formData = {};
      for (const pair of new FormData(form).entries()) {
        formData[pair[0]] = pair[1];
      }
      formData.uuid = uuid();
      form.setAttribute("data-uuid", formData.uuid);
      const formConfig = JSON.parse(
        form.querySelector("script[formconfig]").innerText
      );

      (async () => {
        const response = await fetch(form.getAttribute("data-endpoint"), {
          method: "POST",
          headers: {
            // Accept: "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        });
        const data = await response.json();
        if (formConfig.action == "alert") {
          var alert = form.querySelector(".sic-alertBar");
          if (data.status == "success") {
            alert.classList.add("success");
            alert.innerText = data.message;
            document.querySelector(".sic-form-content").style.display = "none";
          } else {
            alert.classList.add("error");
            alert.innerText = data.message;
          }
          alert.removeAttribute("hidden");
        }
        if (formConfig.action == "nextStep") {
          form.nextElementSibling.setAttribute("data-step", "current");
          form.setAttribute("data-step", "hidden");
        }
      })();
    });
  });
}
