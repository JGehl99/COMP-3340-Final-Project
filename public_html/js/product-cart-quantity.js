// Events for all the decrease quantity buttons
function decreaseAmt(e) {
  e.preventDefault();
  const amtEl = document.getElementById("item-amt");
  const amt = parseInt(amtEl.value);
  if (amt > 0) {
    amtEl.value = amt - 1;
  }
}

const decreaseAmtButton = document.getElementById("decrease-amt");
decreaseAmtButton.onclick = decreaseAmt;

// Events for all the increase quantity buttons
function increaseAmt(e) {
  e.preventDefault();
  const amtEl = document.getElementById("item-amt");
  const amt = parseInt(amtEl.value);
  if (amt < 100) {
    amtEl.value = amt + 1;
  } else {
    alert("Quantity must be less than 100.");
  }
}

const increaseAmtButton = document.getElementById("increase-amt");
increaseAmtButton.onclick = increaseAmt;

// Events to validate typed input for the quantities
function validateAmt(e) {
  e.preventDefault();
  const input = e.target;
  const amt = parseInt(input.value, 10);
  if (isNaN(amt)) {
    input.value = 0;
    alert("Numerical input only.");
  } else if (amt < 0) {
    input.value = 0;
    alert("Quantity must be greater than 0.");
  } else if (amt > 100) {
    input.value = 0;
    alert("Quantity must be less than 100.")
  } else {
    input.value = amt;
  }
}

const amtInput = document.getElementById("item-amt");
// Validate the input when the user de-selects the input element with "onblur" event
amtInput.onblur = validateAmt;