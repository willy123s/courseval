document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll(".activate_status");

  checkboxes.forEach((checkbox) => {
    // Listen for the change event on the checkbox
    checkbox.addEventListener("change", function () {
      const [_, roleId, permissionId] = this.id.split("_");

      const formData = new FormData();
      formData.append("role_id", roleId);
      formData.append("permission_id", permissionId);
      formData.append("status", this.checked ? 1 : 0);

      // Send the POST request when the checkbox state changes
      fetch("/roles/addpermission", {
        method: "POST",
        credentials: "same-origin",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then((data) => {
          const m = document.getElementById("m");
          //   m.append("<div>");
          //   console.log("Success:", data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });
});
