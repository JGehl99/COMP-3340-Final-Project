// Events for all the decrease quantity buttons
function decreaseAmt(e) {
    e.preventDefault();
    const amtEl = document.getElementById('item-amt');
    const amt = parseInt(amtEl.value);
    if (amt > 0) {
        amtEl.value = amt - 1;
    }
}

const decreaseAmtButton = document.getElementById('decrease-amt');
decreaseAmtButton.onclick = decreaseAmt;

// Events for all the increase quantity buttons
function increaseAmt(e) {
    e.preventDefault();
    const amtEl = document.getElementById('item-amt');
    const amt = parseInt(amtEl.value);
    if (amt < 100) {
        amtEl.value = amt + 1;
    } else {
        alert('Quantity must be less than 100.');
    }
}

const increaseAmtButton = document.getElementById('increase-amt');
increaseAmtButton.onclick = increaseAmt;

// Events to validate typed input for the quantities
function validateAmt(e) {
    e.preventDefault();
    const input = e.target;
    const amt = parseInt(input.value, 10);
    if (isNaN(amt)) {
        input.value = 0;
        alert('Numerical input only.');
    } else if (amt < 0) {
        input.value = 0;
        alert('Quantity must be greater than 0.');
    } else if (amt > 100) {
        input.value = 0;
        alert('Quantity must be less than 100.');
    } else {
        input.value = amt;
    }
}

const amtInput = document.getElementById('item-amt');
// Validate the input when the user de-selects the input element with "onblur" event
amtInput.onblur = validateAmt;

function addToCart(e, button) {
    let id = button.getAttribute('data-field');
    const amt = document.getElementById('item-amt').value;
    if (amt < 1) return;
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = () => {
        if (xmlhttp.readyState === 4) {
            const jsonResponse = JSON.parse(xmlhttp.responseText);
            if (xmlhttp.status === 200) {
                if (!jsonResponse['user']) {
                    alert('Please log in to add items to cart');
                } else if (jsonResponse['quantity_cap']) {
                    alert('Quantity cap of 100 reached - set cart capacity to 100');
                } else {
                    alert('Product added to cart successfully');
                }
                console.log('addToCart response: ' + xmlhttp.responseText);
            } else if (xmlhttp.status === 500) {
                console.log('addToCart error: ' + xmlhttp.responseText);
            }
        }
    }

    xmlhttp.open("POST", "../services/add_to_cart.php");
    xmlhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xmlhttp.send(JSON.stringify({pk: id, quantity: amt}));
}

const cartButton = document.getElementById('add-to-cart');
cartButton.onclick = (e) => addToCart(e, cartButton);