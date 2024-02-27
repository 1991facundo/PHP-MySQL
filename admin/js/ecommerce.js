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
    $("#tableCart tbody").text("");
    var TOTAL = 0;
    response.forEach((element) => {
       var price = parseFloat(element["price"]);
       var totalProd = element["quantity"] * price;
      TOTAL = TOTAL + totalProd;
      $("#tableCart tbody").append(
        `
                <tr>
                    <td><img src="${
                      element["web_path"]
                    }" class="img-size-50"/></td>
                    <td>${element["name"]}</td>
                   <td>
                        ${element["quantity"]}
                        <button type="button" class="btn-xs btn-primary plus" 
                        data-id="${element["id"]}"
                        data-type="plus"
                        >+</button>
                        <button type="button" class="btn-xs btn-danger minus" 
                        data-id="${element["id"]}"
                        data-type="minus"
                        >-</button>
                    </td>
                    <td>$${price.toFixed(2)}</td>
                    <td>$${totalProd.toFixed(2)}</td>
                    <td><i class="fa fa-trash text-danger deleteProduct" data-id="${
                      element["id"]
                    }" ></i></td>
                <tr>
                `
      );
    });
    $("#tableCart tbody").append(
      `
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td>${TOTAL.toFixed(2)}</td>
                <td></td>
            <tr>
            `
    );
  }

      $(document).on("click", ".plus,.minus", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var type = $(this).data("type");
        $.ajax({
          type: "post",
          url: "ajax/changeProdQuantity.php",
          data: { id: id, type: type },
          dataType: "json",
          success: function (response) {
            fillTableCart(response);
            fillCart(response);
          },
        });
      });
      $(document).on("click", ".deleteProduct", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
          type: "post",
          url: "ajax/deleteProdCart.php",
          data: { id: id },
          dataType: "json",
          success: function (response) {
            fillTableCart(response);
            fillCart(response);
          },
        });
      });

  // ADD TO CART
  $("#addCart").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var name = $(this).data("name");
    var web_path = $(this).data("web_path");
    var quantity = $("#quantity").val();
    var price = $(this).data("price");
    $.ajax({
      type: "POST",
      url: "ajax/addCart.php",
      data: {
        id: id,
        name: name,
        web_path: web_path,
        quantity: quantity,
        price: price,
      },
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
