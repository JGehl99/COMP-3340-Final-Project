// Events for all the decrease quantity buttons
function decreaseAmt(e, button) {
    e.preventDefault();
    const amtElName = button.getAttribute('data-field') + '-amt';
    const amtEl = document.getElementById(amtElName);
    const amt = parseInt(amtEl.value);
    if (amt > 0) {
        amtEl.value = amt - 1;
    }
}

const decreaseAmtButtons = document.querySelectorAll('.decrease-amt');
for (let button of decreaseAmtButtons) {
    button.onclick = (e) => decreaseAmt(e, button);
}

// Events for all the increase quantity buttons
function increaseAmt(e, button) {
    e.preventDefault();
    const amtElName = button.getAttribute('data-field') + '-amt';
    const amtEl = document.getElementById(amtElName);
    const amt = parseInt(amtEl.value);
    if (amt < 100) {
        amtEl.value = amt + 1;
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

const amtInputs = document.querySelectorAll('.amt');
for (let amtInput of amtInputs) {
    // Validate the input when the user de-selects the input element with "onblur" event
    amtInput.onblur = (e) => validateAmt(e, amtInput);
}

function linkToProduct(e) {
    e.preventDefault();

    // Starting from the innermost clicked element, check it and each successor element for a data-node-link attribute.
    // If one is found, then do not redirect.
    // If the parent <a> is found before finding a data-no-link attribute, then redirect

    let el = e.target;
    while (el !== null && el.nodeName.toLowerCase() !== 'a') {
        if (el.hasAttribute('data-no-link')) {
            return;
        }
        el = el.parentElement;
    }

    if (el.nodeName.toLowerCase() !== null && el.hasAttribute('data-item-id')) {
        window.location.href = `product.php?item-id=${el.getAttribute('data-item-id')}`;
    }
}

const productLinks = document.querySelectorAll('.product-link');
for (let productLink of productLinks) {
    productLink.onclick = linkToProduct;
}

function addToCart(e, button) {
    let id = button.getAttribute('data-field');
    const amt = document.getElementById(id + '-amt').value;
    if (amt < 1) return;
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onload = () => {
        if (xmlhttp.readyState === 4) {
            const jsonResponse = JSON.parse(xmlhttp.responseText);
            if (xmlhttp.status === 200) {
                if (jsonResponse['quantity_cap']) {
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

const cartButtons = document.querySelectorAll('.add-to-cart');
for (let button of cartButtons) {
    button.onclick = (e) => addToCart(e, button);
}