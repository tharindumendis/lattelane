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
var isCardFormVisible = false;

function showPaymentForm() {
  const paymentMethod = document.getElementById("paymentMethod");
  const cardForm = document.getElementById("cardForm");
  const cardDetailsContainer = document.getElementById("cardForm");
  const cardBtncod = document.getElementById("cardBtncod");

  if (isCardFormVisible) {
    console.log("COD");
    cardDetailsContainer.style.display = "none";
    cardBtncod.innerHTML = `<div class="checkoutBtn" id="checkoutBtn">
    <i class="fa-solid fa-cart-shopping"></i>
    <p> C h e c k _O u t</p>
    <input class="iSubmit" type='submit' name='submitInvoice' id='' value="submitInvoice">
    </div>`;

    isCardFormVisible = !isCardFormVisible;
  } else {
    console.log("COD");
    cardDetailsContainer.style.display = "flex";
    cardBtncod.innerText = `Enter Card Details`;
    isCardFormVisible = !isCardFormVisible;
  }
}

