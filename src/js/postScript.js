console.log("poatscript");
$(document).ready(function () {
  $("[name='add-to-cart']").click(function () {
    var productId = $(this).data("product-id");
    $.ajax({
      url: "add_to_cart.php",
      type: "POST",
      data: { product_id: productId },
      success: function (response) {
        console.log(response);
      },
      error: function (xhr, status, error) {
        console.error("Error: " + error);
      },
    });
  });
});

console.log("poatscript");




