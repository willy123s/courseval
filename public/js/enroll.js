function getCheckedCheckboxes() {
  // Get the list element
  var list = document.getElementById("checkboxList");

  // Get all checkboxes inside the list
  var checkboxes = list.querySelectorAll("input[type='checkbox']");

  // Filter checked checkboxes
  var checkedCheckboxes = Array.from(checkboxes).filter(
    (checkbox) => checkbox.checked
  );

  const studno = document.getElementById("studno");

  var formData = new FormData();

  // Append checked values to FormData
  checkedCheckboxes.forEach((checkbox) => {
    formData.append("checkedValues[]", checkbox.value);
  });
  // Append additional data to FormData
  if (studno) {
    formData.append("studno", studno.value);
  }

  fetch("/enrollments/save", {
    method: "POST",

    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      const myToast = new Toast();
      myToast.showToast(data);
    })
    .catch((error) => console.error("Error sending data to server:", error));
}
