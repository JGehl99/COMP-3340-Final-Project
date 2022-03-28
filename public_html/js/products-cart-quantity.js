// Events for all the decrease quantity buttons
function decreaseAmt(e, button) {
  e.preventDefault();
  const amtElName = button.getAttribute("data-field");
  const amtEl = document.getElementById(amtElName);
  const amt = parseInt(amtEl.value);
  if (amt > 0) {
    amtEl.value = amt - 1;
  }
}

const decreaseAmtButtons = document.querySelectorAll(".decrease-amt");
for (let button of decreaseAmtButtons) {
  button.onclick = (e) => decreaseAmt(e, button);
}

// Events for all the increase quantity buttons
function increaseAmt(e, button) {
  e.preventDefault();
  const amtElName = button.getAttribute("data-field");
  const amtEl = document.getElementById(amtElName);
  const amt = parseInt(amtEl.value);
  if (amt < 100) {
    amtEl.value = amt + 1;
  } else {
    alert("Can only have 100 of an item in your cart.");
  }
}

const increaseAmtButtons = document.querySelectorAll(".increase-amt");
for (let button of increaseAmtButtons) {
  button.onclick = (e) => increaseAmt(e, button);
}
