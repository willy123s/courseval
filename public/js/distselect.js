const main = document.getElementById("main");
if (main) {
  main.addEventListener("click", function (event) {
    const input = document.getElementById("distination");
    const select = document.getElementById("office");
    //   const saveButton = document.getElementById("save-office");
    let selectedOfficeId = null;

    input.addEventListener("input", function () {
      const search = input.value.trim();
      const formData = new FormData();

      formData.append("search", search);
      if (search.length >= 3) {
        fetch("/api/office", {
          method: "POST",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content"),
          },
          body: formData,
        })
          .then((response) => response.json())
          .then((offices) => {
            // alert(offices);
            select.innerHTML = "";
            select.style.display = "block";
            offices.forEach((office) => {
              const option = document.createElement("option");
              option.value = office.id;
              option.textContent = office.name;
              select.appendChild(option);
            });
          });
      } else {
        select.style.display = "none";
        selectedOfficeId = null;
      }
    });

    select.addEventListener("change", function () {
      selectedOfficeId = this.value;
      input.value = this.options[this.selectedIndex].textContent;
    });
  });
}
//   saveButton.addEventListener("click", function () {
//     if (selectedOfficeId) {
//       console.log("Selected office ID:", selectedOfficeId);
//       // Add your saving logic here
//     } else {
//       console.log("No office selected");
//     }
//   });
