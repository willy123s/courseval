$(document).ready(function () {
  $("body").on("click", "#cancel-btn", function (e) {
    var id = $(this).attr("data-id");
    e.preventDefault();
    $.ajax({
      url: "/requests/cancel",
      type: "post",
      dataType: "text",
      data: { id: id },
      success: function (f) {
        alert(f);
      },
    });
  });
});
