let itemTotal = document.getElementsByName("itemTotal");
let itemTotalValue;
let itemValue = [];

function updateCartTotal() {
  itemValue = [];
  for (var i = 0; i < itemTotal.length; i++) {
    itemValue.push(parseFloat(itemTotal[i].value) || 0);
  }
  itemTotalValue = itemValue.reduce((sum, value) => sum + value, 0);
  document.getElementById("cartTotal").innerHTML =
    "Rs." + itemTotalValue.toFixed(2);
}

setInterval(updateCartTotal, 1000);
updateCartTotal();

document
  .getElementById("removeFromCart")
  .addEventListener("click", function () {
    alert("Item removed from cart");
    setTimeout(() => {
      alert("reload1");
      window.location.reload();
      alert("reload2");
    }, 1000);
  });

function showPaymentForm() {

  const paymentMethod = document.getElementById("paymentMethod");
  const cardForm = document.getElementById("cardForm");

  if (paymentMethod.value === "cod") {
    cardForm.style.display = "none";
  } else {
    cardForm.style.display = "block";
  }
}

showPaymentForm();