// Get all elements with the class "prereq"
const elements = document.querySelectorAll(".prereq");

// Add an event listener to each element
elements.forEach(function (element) {
  element.addEventListener("dblclick", function () {
    element.setAttribute("contenteditable", true);
  });
  element.addEventListener("blur", function () {
    // Handle the event for each element
    const dataId = element.getAttribute("data-id");
    let content = element.textContent;
    let c = element.getAttribute("data-curr");

    const formData = new FormData();
    formData.append("content", content);
    formData.append("curr", c);
    formData.append("currdetid", dataId);

    url = "/Prerequisites/save";
    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.result != 1) {
          element.classList.remove("border-slate-700/10");
          element.classList.add("border-danger");
        } else {
          element.classList.remove("border-slate-700/10");
          element.classList.remove("border-danger");
          element.classList.add("border-success");
        }
        element.innerHTML = data.prereq + "&nbsp;";
        element.removeAttribute("contenteditable");
      })
      .catch((error) => console.error("Error fetching data:", error));
  });
});
