$(document).ready(function () {
  $("body").on("keyup", "#filterSubject", function () {
    $key = $(this).val();
    $t = $(this).attr("data-target");
    $c = $(this).attr("data-curr");
    const resultContainer = document.getElementById("resultContainer");
    const formData = new FormData();
    formData.append("key", $key);
    formData.append("target", $t);
    formData.append("curr", $c);

    url = "/api/fetch";
    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        resultContainer.innerHTML = data;
      })
      .catch((error) => console.error("Error fetching data:", error));
  });
});
