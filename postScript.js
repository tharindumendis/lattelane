$(document).ready(function () {
  $("[name='add-to-cart']").click(function () {
    var productId = $(this).data("product-id");
    $.ajax({
      url: "add_to_cart.php",
      type: "POST",
      data: { product_id: productId },
      success: function (response) {
        alert("Product added to cart!", productId);
      },
      error: function (xhr, status, error) {
        console.error("Error: " + error);
      },
    });
  });
});


