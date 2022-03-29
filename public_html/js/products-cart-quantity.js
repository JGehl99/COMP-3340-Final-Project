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
    alert("Quantity must be less than 100.");
  }
}

const increaseAmtButtons = document.querySelectorAll(".increase-amt");
for (let button of increaseAmtButtons) {
  button.onclick = (e) => increaseAmt(e, button);
}

// Events to validate typed input for the quantities
function validateAmt(e, input) {
  e.preventDefault();
  const amt = parseInt(input.value, 10);
  console.log(amt);
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

const amtInputs = document.querySelectorAll(".amt");
for (let amtInput of amtInputs) {
  // Validate the input when the user de-selects the input element with "onblur" event
  amtInput.onblur = (e) => validateAmt(e, amtInput);
}