const subEl = document.getElementById('subtotal');
const taxEl = document.getElementById('taxes');
const totalEl = document.getElementById('total');

function updateCart() {
    const xmlhttp = new XMLHttpRequest();

    const amts = document.querySelectorAll('.amt');
    let ids = [];
    let quantities = [];
    for (let amt of amts) {
        ids.push(amt.getAttribute('data-field'));
        quantities.push(amt.value);
    }
    xmlhttp.onload = () => {
        if (xmlhttp.readyState === 4) {
            if (xmlhttp.status === 200) {
                console.log('updateQuantity response: ' + xmlhttp.responseText);
            } else if (xmlhttp.status === 500) {
                console.log('updateQuantity error: ' + xmlhttp.responseText);
            }
        }
    }
    xmlhttp.open("POST", "../services/update_cart_quantity.php");
    xmlhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xmlhttp.send(JSON.stringify({pks: ids, quantities: quantities}));
}

function deleteCartItem(id) {
    if (!confirm('Are you sure you want to remove this item from your cart?')) return;
    const rowEl = document.getElementById(id + '-row');
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = () => {
        if (xmlhttp.readyState === 4) {
            const jsonResponse = JSON.parse(xmlhttp.responseText);
            if (xmlhttp.status === 200) {
                if (jsonResponse['empty']) {
                    const cartEl = document.getElementById('cart');
                    const emptyEl = document.getElementById('empty-cart');
                    cartEl.remove();
                    emptyEl.classList.remove('d-none');
                }
                rowEl.remove();
                console.log('deleteCartItem response: ' + xmlhttp.responseText);
            } else if (xmlhttp.status === 500) {
                console.log('deleteCartItem error: ' + xmlhttp.responseText);
            }
        }
    }
    xmlhttp.open("POST", "../services/remove_from_cart.php");
    xmlhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xmlhttp.send(JSON.stringify({pk: id}));
}

function updateTotals(id, amt) {
    const prodSubEl = document.getElementById(id + '-subtotal');
    prodSubEl.innerHTML = '$' + (prodSubEl.getAttribute('data-field') * amt).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    const subtotals = document.querySelectorAll('.subtotal');
    let sum = 0;
    for (let subtotal of subtotals) {
        let temp = subtotal.innerHTML;
        sum += Number(temp.replace(/[^0-9.-]+/g, ""));
    }
    subEl.innerHTML = '$' + sum.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    taxEl.innerHTML = '$' + (sum * 0.13).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    totalEl.innerHTML = '$' + (sum * 1.13).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function deleteItemClick(button) {
    const id = button.getAttribute('data-field');
    deleteCartItem(id);
}

const deleteButtons = document.querySelectorAll('.remove-item');
for (let button of deleteButtons) {
    button.onclick = () => deleteItemClick(button);
}

// Events for all the decrease quantity buttons
function decreaseAmt(e, button) {
    e.preventDefault();
    const id = button.getAttribute('data-field');
    const amtEl = document.getElementById(id + '-amt');
    const amt = parseInt(amtEl.value);
    if (amt > 1) {
        amtEl.value = amt - 1;
        updateTotals(id, amtEl.value);
    } else if (amt === 1) {
        deleteCartItem(id);
    }
}

const decreaseAmtButtons = document.querySelectorAll('.decrease-amt');
for (let button of decreaseAmtButtons) {
    button.onclick = (e) => decreaseAmt(e, button);
}

// Events for all the increase quantity buttons
function increaseAmt(e, button) {
    e.preventDefault();
    const id = button.getAttribute('data-field');
    const amtEl = document.getElementById(id + '-amt');
    const amt = parseInt(amtEl.value);
    if (amt < 100) {
        amtEl.value = amt + 1;
        updateTotals(id, amtEl.value);
    } else {
        alert('Quantity must be less than 100.');
    }
}

const increaseAmtButtons = document.querySelectorAll('.increase-amt');
for (let button of increaseAmtButtons) {
    button.onclick = (e) => increaseAmt(e, button);
}

// Events to validate typed input for the quantities
function validateAmt(e, input) {
    e.preventDefault();
    const amt = parseInt(input.value, 10);
    if (isNaN(amt)) {
        alert('Numerical input only.');
    } else if (amt < 1) {
        alert('Quantity must be greater than 0.');
    } else if (amt > 100) {
        alert('Quantity must be less than 100.');
    } else {
        input.value = amt;
        updateTotals(input.getAttribute('data-field'), amt);
    }
}

const amtInputs = document.querySelectorAll('.amt');
for (let amtInput of amtInputs) {
    // Validate the input when the user de-selects the input element with "onblur" event
    amtInput.onblur = (e) => validateAmt(e, amtInput);
}

function checkout() {
    updateCart();
}

const checkoutButton = document.getElementById('checkout');
checkoutButton.onclick = () => checkout();