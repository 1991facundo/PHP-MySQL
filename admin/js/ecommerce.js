$(document).ready(function () {
  $("#addCart").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var name = $(this).data("name");
    var web_path = $(this).data("web_path");
    var prodQuantity = $("#prodQuantity").val();
    $.ajax({
      type: "post",
      url: "ajax/addCart.php",
      data: { id: id, name: name, web_path: web_path, quantity: prodQuantity },
      dataType: "json",
      success: function (response) {
        var prodQuantity = Object.keys(response).length;
        $("#badgeProduct").text(prodQuantity);
      },
    });
  });
});
