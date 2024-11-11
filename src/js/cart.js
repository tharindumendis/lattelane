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

    checkoutButton.style.display = "flex";
  } else {
    cardForm.style.display = "block";
  }
}

function cardFormShow() {
  const cardDetailsContainer = document.getElementById("cardForm");
  const cardNumber = document.getElementById("cardNumber");
  const cardName = document.getElementById("cardName");
  const expiryDate = document.getElementById("expiryDate");
  const cvv = document.getElementById("cvv");
  const checkoutButton = document.getElementById("checkoutBtn");
  const cardBtn = document.getElementById("cardBtn");
  const cardBtncod = document.getElementById("cardBtncod");
 


  cardBtncod.innerText = ``;

  cardDetailsContainer.style.display = "flex";
  cardNumber.required = true;
  cardName.required = true;
  expiryDate.required = true;
  cvv.required = true;
  console.log("cardFormShow");
}
function cardFormhide() {
  const cardDetailsContainer = document.getElementById("cardForm");
  const checkoutButton = document.getElementById("checkoutBtn");
  const cardNumber = document.getElementById("cardNumber");
  const cardName = document.getElementById("cardName");
  const expiryDate = document.getElementById("expiryDate");
  const cvv = document.getElementById("cvv");
  const cardBtncod = document.getElementById("cardBtncod");
  
  checkoutButton.style.display = "flex";
  
  cardDetailsContainer.display = "none";

  cardBtncod.innerHTML = `<div class="checkoutBtn" id="checkoutBtn">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p> C h e c k _O u t</p>
                        <input class="iSubmit" type='submit' name='submitInvoice' id='' value="submitInvoice">
                    </div>`;
  cardDetailsContainer.style.display = "flex";
  cardNumber.required = false;
  cardName.required = false;
  expiryDate.required = false;
  cvv.required = false;


  console.log("cardFormhide");
}
