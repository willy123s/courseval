let flag = false;
// const form = document.getElementById("addDoc");

document.addEventListener("click", function (event) {
  const fileInput = document.getElementById("file");
  const fileNameSpan = document.getElementById("filename");
  const msg = document.getElementById("validatemsg");

  if (fileInput) {
    fileInput.addEventListener("change", function () {
      const file = this.files[0];

      // Check if the selected file is an image file
      const fileTypes = ["image/png", "image/jpeg", "image/webp", "image/jfif"];
      if (!fileTypes.includes(file.type)) {
        msg.innerText =
          "Invalid file type. Please select a PNG, JPEG, or BMP file.";
        this.value = null;
        fileNameSpan.innerText = "Select File Sample";
        flag = false;
        return;
      } else {
        // Update the filename span with the selected file name
        fileNameSpan.innerText = file.name;
        flag = true;
      }
    });
  }

  //   if (form) {
  //     form.addEventListener("submit", function (event) {
  //       if (!flag) {
  //         event.preventDefault();
  //       }
  //     });
  //   }
});
