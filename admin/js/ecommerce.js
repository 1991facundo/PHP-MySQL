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

 $.ajax({
   type: "post",
   url: "ajax/readCart.php",
   dataType: "json",
   success: function (response) {
     fillTableCart(response);
   },
 });
 function fillTableCart(response) {
   var TOTAL = 0;
   response.forEach((element) => {
     var totalProd = element["quantity"] * element["price"];
     TOTAL = TOTAL + totalProd;
     $("#tableCart").append(
       `
                <tr>
                    <td><img src="${element["web_path"]}" class="img-size-50"/></td>
                    <td>${element["name"]}</td>
                    <td>${element["quantity"]}</td>
                    <td>${element["price"]}</td>
                    <td>${totalProd}</td>
                    <td><i class="fa fa-trash text-danger"></i></td>
                <tr>
                `
     );
   });
   $("#tableCart").append(
     `
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td>${TOTAL}</td>
                <td></td>
            <tr>
            `
   );
 }


  // ADD TO CART
  $("#addCart").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var name = $(this).data("name");
    var web_path = $(this).data("web_path");
    var quantity = $("#quantity").val();
    var price = $(this).data('price')
    $.ajax({
      type: "POST",
      url: "ajax/addCart.php",
      data: { id: id, name: name, web_path: web_path, quantity: quantity, price: price},
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
              <p class="text-sm">Quantity ${element.quantity}</p>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>`
      );
    });
    $("#listCart").append(
      `
      <a href="index.php?module=cart" class="dropdown-item dropdown-footer text-primary">
                See Cart 
                <i class="fa fa-cart-plus"></i>
            </a>
            <div class="dropdown-divider"></div>

      <a href="#" class="dropdown-item dropdown-footer text-danger" id="deleteCart">
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
