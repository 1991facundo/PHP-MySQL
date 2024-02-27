$(document).ready(function () {
  //READ CART

  $.ajax({
    type: "post",
    url: "ajax/readCart.php",
    dataType: "json",
    success: function (response) {
      fillCart(response);
    },
  });

  // ADD TO CART
  $("#addCart").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var name = $(this).data("name");
    var web_path = $(this).data("web_path");
    var prodQuantity = $("#prodQuantity").val();
    $.ajax({
      type: "POST",
      url: "ajax/addCart.php",
      data: { id: id, name: name, web_path: web_path, quantity: prodQuantity },
      dataType: "json",
      success: function (response) {
        fillCart(response);
        $("#badgeProduct")
          .hide(500)
          .show(500)
          .hide(500)
          .show(500)
          .hide(500)
          .show(500);
        $("#iconCart").click();
      },
    });
  });

  // FILL CART
  function fillCart(response) {
    var totalQuantity = 0;
    response.forEach(function (item) {
      totalQuantity += parseInt(item.quantity);
    });
    if (totalQuantity > 0) {
      $("#badgeProduct").text(totalQuantity);
    } else {
      $("#badgeProduct").text("");
    }
    $("#listCart").empty(); 
    response.forEach(function (element) {
      $("#listCart").append(
        `<a href="index.php?module=detailProduct&id=${element.id}" class="dropdown-item">
          <div class="media">
            <img src="${element.web_path}" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                ${element.name}
                <span class="float-right text-sm text-primary"><i class="fas fa-eye"></i></span>
              </h3>
              <p class="text-sm">Cantidad ${element.quantity}</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>`
      );
    });
    $("#listCart").append(
      `<a href="#" class="dropdown-item dropdown-footer text-danger" id="deleteCart">
        Delete Cart 
        <i class="fa fa-trash"></i>
      </a>`
    );
  }

  //DELETE CART
  $(document).on("click", "#deleteCart", function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "ajax/deleteCart.php",
      dataType: "json",
      success: function (response) {
        fillCart(response);
      },
    });
  });
});
