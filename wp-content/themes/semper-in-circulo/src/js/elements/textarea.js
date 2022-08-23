const tx = document.querySelectorAll("textarea.autosize");
for (let i = 0; i < tx.length; i++) {
  tx[i].setAttribute(
    "style",
    "height:" + tx[i].scrollHeight + "px;overflow-y:hidden;"
  );
  window.addEventListener("DOMContentLoaded", function () {
    OnInput(tx[i]);
  });
  window.addEventListener("TextareaAutosize", function () {
    OnInput(tx[i]);
  });
  tx[i].addEventListener(
    "input",
    function () {
      OnInput(tx[i]);
    },
    false
  );
}

function OnInput(textarea) {
  var borderWidth = parseInt(
    getComputedStyle(textarea, null)
      .getPropertyValue("border-width")
      .split("px")[0]
  );
  textarea.style.height = "auto";
  textarea.style.height = textarea.scrollHeight + 2 * borderWidth + "px";
}
