document.addEventListener("DOMContentLoaded", function () {
  const loadSubjects = document.getElementById("loadSubjects");
  if (loadSubjects) {
    loadSubjects.addEventListener("click", function () {
      const year = document.getElementById("year");
      const sem = document.getElementById("sem");
      const studno = document.getElementById("studno");
      const enrollid = document.getElementById("enrollid");
      const formData = new FormData();
      if (studno) {
        formData.append("studno", studno.getAttribute("data-studno"));
      }

      formData.append("enid", enrollid.getAttribute("data-value"));
      formData.append("year", year.value);
      formData.append("sem", sem.value);

      url = "/preenroll/load";
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
