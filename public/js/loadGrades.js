document.addEventListener("DOMContentLoaded", function () {
  const loadGrades = document.getElementById("loadGrades");
  if (loadGrades) {
    loadGrades.addEventListener("click", function () {
      const studno = document.getElementById("studno");
      const formData = new FormData();
      if (studno) {
        formData.append("studno", studno.value);
      }

      url = "/studentgrades/load";
      fetch(url, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          const container = document.getElementById("itemContainer");
          container.innerHTML = data;
        })
        .catch((error) => console.error("Error fetching data:", error));
    });
  }
});
