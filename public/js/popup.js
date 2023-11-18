// document.addEventListener("mouseover", function () {
document.body.addEventListener("click", function (event) {
  const popelement = document.querySelectorAll(".pop");

  var target = event.target;

  if (target.classList.contains("pop") || target.closest(".pop")) {
    // popelement.forEach((element) => {
    // element.addEventListener("click", function (event) {
    //   var target = element;
    // Check if the clicked element has the class 'pop'

    var e = target.closest(".pop");

    event.preventDefault();

    const url =
      target.getAttribute("data-remote") ?? e.getAttribute("data-remote");
    const title =
      target.getAttribute("data-title") ?? e.getAttribute("data-title");
    const id = target.getAttribute("data-id") ?? e.getAttribute("data-id");
    const size =
      target.getAttribute("data-size") ?? e.getAttribute("data-size");

    // Create the main elements
    const dialog = document.createElement("dialog");
    const flexContainer = document.createElement("div");
    const popContainer = document.createElement("div");
    const dialogcont = document.createElement("div");

    // Set the attributes and classes
    dialog.id = "popdialog";
    dialog.classList.add(
      "bg-black/30",
      "h-screen",
      "w-full",
      "overflow-y-auto",
      "z-20",
      "backdrop-blur-sm"
    );

    flexContainer.classList.add(
      "flex",
      "flex-row",
      "w-full",
      "h-full",
      "justify-center",
      "items-center"
    );

    popContainer.id = "pop";
    popContainer.classList.add(
      "bg-white",
      ...(size ? size.split(" ") : []),
      "mx-6",
      "my-5",
      "p-5",
      "rounded-xl",
      "shadow-xl",
      "shadow-black/10",
      "ease-in-out",
      "duration-100"
    );

    dialogcont.id = "dialogcontent";

    // Append the elements to create the structure
    popContainer.appendChild(dialogcont);
    flexContainer.appendChild(popContainer);
    dialog.appendChild(flexContainer);

    document.body.appendChild(dialog);

    var popDialog = document.getElementById("popdialog");
    popDialog.style.display = "block";

    var pop = document.getElementById("pop");

    var dialogContent = document.getElementById("dialogcontent");

    dialogContent.innerHTML = "";

    // Fetch content from the server and load it into the dialog content
    fetch(url)
      .then((response) => {
        return response.text();
      })
      .then((data) => {
        const parser = new DOMParser();
        const parsedHtml = parser.parseFromString(data, "text/html");

        const scripts = parsedHtml.querySelectorAll("script");
        scripts.forEach((script) => {
          const newScript = document.createElement("script");
          newScript.innerHTML = script.innerHTML;
          document.body.appendChild(newScript);
        });
        pop.classList.add("scale-50");
        dialogContent.innerHTML = parsedHtml.body.innerHTML;
        pop.classList.remove("scale-50");
      })
      .catch((error) => console.error("Error fetching data:", error));

    document.body.addEventListener("click", function (event) {
      var closeBtn = event.target.closest(".close");
      if (closeBtn) {
        pop.classList.add("scale-0");
        setTimeout(() => {
          popDialog.remove();
        }, 100);
      }
    });

    document.body.addEventListener("keyup", function (event) {
      // Check if the pressed key is the "Escape" key (key code 27)
      if (event.key === "Escape") {
        // Remove the #popdialog element
        pop.classList.add("scale-0");
        setTimeout(() => {
          popDialog.remove();
        }, 100);
      }
    });
  }
  // });
});
