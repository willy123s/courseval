$("body").on("change", ".select-office", function () {
  var officeid = $(this).val();

  jQuery.ajax({
    type: "POST",
    url: "/api/read/service/" + officeid,
    // data: "oid=" + officeid,
    dataType: "text",
    success: function (f) {
      // alert(f);
      $("#purpose").html(f);
      $("#purpose").removeAttr("disabled");
    },
  });
});
