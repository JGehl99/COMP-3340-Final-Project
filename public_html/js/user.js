function userDeleteRecord(rowId, recordType)
{
    const rowEl = document.getElementById(rowId);
    let btnEl;

    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                rowEl.remove();
                btnEl.classList.remove('d-none');
                console.log('deleteRecord response: ' + xhttp.responseText);
            } else if (xhttp.status === 500) {
                console.log('deleteRecord error: ' + xhttp.responseText);
            }
        }
    };

    // Send a request
    let url = '';
    if (recordType === 2) {
        url = '../services/delete_shipping.php';
        btnEl = document.getElementById('create-shipping-btn');
    } else if (recordType === 3) {
        url = '../services/delete_billing.php';
        btnEl = document.getElementById('create-billing-btn');
    }


    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify({ pk: rowId }));
    } else {
        console.error('Cannot delete record: invalid record type.');
    }
}

function userToggleRecordEditable(rowId)
{
    const rowEl = document.getElementById(rowId);
    const tds = rowEl.children;
    const editable = !tds[0].firstElementChild.hasAttribute('readonly');
    for (let i = 0; i < tds.length - 1; ++i) {
        const inputEl = tds[i].firstElementChild;
        if (editable) {
            inputEl.setAttribute('readonly', '');
            // Reset input to its old value, since the edit was not confirmed
            inputEl.value = inputEl.getAttribute('value');
        } else {
            inputEl.removeAttribute('readonly');
        }
    }
}

function userConfirmRecordEdit(rowId, recordType)
{
    const rowEl = document.getElementById(rowId);

    // First, validate the input
    if (recordType === 2 && !validateShippingInput(rowEl)) {
        console.log('Invalid shipping info.');
        userToggleRecordEditable(rowId);
        return;
    } else if (recordType === 3 && !validateBillingInput(rowEl)) {
        console.log('Invalid billing info.');
        userToggleRecordEditable(rowId);
        return;
    }

    // Then, make all the fields readonly and check for changes
    const tds = rowEl.children;
    let changedFields = {};
    for (let i = 0; i < tds.length - 1; ++i) {
        const inputEl = tds[i].firstElementChild;
        inputEl.setAttribute('readonly', '');

        // Checking if any values have changed
        if (inputEl.value !== inputEl.getAttribute('value')) {
            changedFields[inputEl.getAttribute('name')] = inputEl.value;
            // Also update the value attribute so this new value is checked for changes on subsequent edits
            inputEl.setAttribute('value', inputEl.value);
        }
    }

    // If any fields have been changed, send them to updateRecord()
    const recordChanged = Object.keys(changedFields).length !== 0;
    if (recordChanged) {
        userUpdateRecord(rowId, changedFields, recordType);
    }
}

function userUpdateRecord(rowId, changedFields, recordType)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                console.log('updateRecord response: ' + xhttp.responseText);
            } else if (xhttp.status === 500) {
                console.log('updateRecord error: ' + xhttp.responseText);
            }
        }
    };

    // Send a request
    const jsonObj = {
        pk: rowId,
        ...changedFields,
    };

    let url = '';
    if (recordType === 2) {
        url = '../services/update_shipping.php';
    } else if (recordType === 3) {
        url = '../services/update_billing.php';
    }

    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify(jsonObj));
    } else {
        console.error('Cannot update record: invalid record type.');
    }
}

function createNewShippingRow(username)
{
    // Don't let the admin click add shipping info before finishing a record they are already creating.
    // NOTE: this should never happen since the button should be hidden once clicked. This check is made just in case.
    if (document.getElementById('new-shipping') !== null) {
        console.log('Already creating new shipping record.');
        return;
    }

    // Hide the button (show again by removing the class)
    document.getElementById('create-shipping-btn').classList.add('d-none');

    const tbody = document.getElementById('shipping-tbody');
    const newShippingRow = document.createElement('tr');
    newShippingRow.setAttribute('id', 'new-shipping');
    newShippingRow.className = 'bg-secondary';
    newShippingRow.innerHTML = `
        <td>
            <input type="text"
                   name="street_num"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="street_name"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="city"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="province"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="postal_code"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <button type="button" class="btn-empty cancel-add-record"
                    onclick="userCancelAddNewRecord(2)">
                <img src="../static/close_black.svg"
                     alt="Cancel"
                     class="delete_icon"/>
            </button>
            <button type="button" class="btn-empty confirm-add-record"
                    onclick="userConfirmAddNewRecord(2, '${username}')">
                <img src="../static/check_black.svg"
                     alt="Confirm"
                     class="confirm_icon"/>
            </button>
        </td>
    `;
    tbody.appendChild(newShippingRow);
}

function createNewBillingRow(username)
{
    // Don't let the admin click add billing info before finishing a record they are already creating.
    // NOTE: this should never happen since the button should be hidden once clicked. This check is made just in case.
    if (document.getElementById('new-billing') !== null) {
        console.log('Already creating new billing record.');
        return;
    }

    // Hide the button (show again by removing the class)
    document.getElementById('create-billing-btn').classList.add('d-none');

    const tbody = document.getElementById('billing-tbody');
    const newBillingRow = document.createElement('tr');
    newBillingRow.setAttribute('id', 'new-billing');
    newBillingRow.className = 'bg-secondary';
    newBillingRow.innerHTML = `
        <td>
            <input type="text"
                   name="card_num"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="card_name"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="exp_date"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="cvv"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <button type="button" class="btn-empty cancel-add-record"
                    onclick="userCancelAddNewRecord(3)">
                <img src="../static/close_black.svg"
                     alt="Cancel"
                     class="delete_icon"/>
            </button>
            <button type="button" class="btn-empty confirm-add-record"
                    onclick="userConfirmAddNewRecord(3, '${username}')">
                <img src="../static/check_black.svg"
                     alt="Confirm"
                     class="confirm_icon"/>
            </button>
        </td>
    `;
    tbody.appendChild(newBillingRow);
}

function userCancelAddNewRecord(recordType)
{
    let rowEl;
    let btnEl;
    if (recordType === 2) {
        rowEl = document.getElementById('new-shipping');
        btnEl = document.getElementById('create-shipping-btn');
    } else if (recordType === 3) {
        rowEl = document.getElementById('new-billing');
        btnEl = document.getElementById('create-billing-btn');
    } else {
        return;
    }

    // Remove the row and show the button
    rowEl.remove();
    btnEl.classList.remove('d-none');
}

function userConfirmAddNewRecord(recordType, username)
{
    let rowEl;
    let btnEl;
    let url;
    // Validate input
    if (recordType === 2) {
        rowEl = document.getElementById('new-shipping');
        btnEl = document.getElementById('create-shipping-btn');
        if (validateShippingInput(rowEl)) {
            url = '../services/add_shipping.php';
        } else {
            console.log('Invalid shipping input.');
            return;
        }
    } else if (recordType === 3) {
        rowEl = document.getElementById('new-billing');
        btnEl = document.getElementById('create-billing-btn');
        if (validateBillingInput(rowEl)) {
            url = '../services/add_billing.php';
        } else {
            console.log('Invalid billing input.');
            return;
        }
    } else {
        console.error('Cannot add record: invalid record type.');
        return;
    }

    // Get the fields
    const tds = rowEl.children;
    let fields = { username: username };
    for (let i = 0; i < tds.length - 1; ++i) {
        const inputEl = tds[i].firstElementChild;
        // Make the input readonly
        inputEl.setAttribute('readonly', '');

        // Add the field for the JSON request
        fields[inputEl.getAttribute('name')] = inputEl.value;

        // Also update the value attribute so this new value is checked for changes on subsequent edits
        inputEl.setAttribute('value', inputEl.value);
    }

    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            const jsonResponse = JSON.parse(xhttp.responseText);
            if (xhttp.status === 200) {
                console.log('addNewRecord response: ' + jsonResponse);
                userUpdateNewRowData(rowEl, btnEl, jsonResponse['id'], recordType, username);
            } else if (xhttp.status === 500) {
                console.log('addNewRecord error: ' + jsonResponse);
            }
        }
    };

    // Send a request
    xhttp.open('POST', url);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xhttp.send(JSON.stringify(fields));
}

function validateShippingInput(rowEl)
{
    // Street Number should be between 1 and 255 characters
    const street_num = rowEl.querySelector('input[name=\'street_num\']').value;
    if (street_num.length < 1 || street_num.length > 255) return false;

    // Street Name should be between 5 and 255 characters
    const street_name = rowEl.querySelector('input[name=\'street_name\']').value;
    if (street_name.length < 5 || street_num.length > 255) return false;

    // City should be between 3 and 255 characters
    const city = rowEl.querySelector('input[name=\'city\']').value;
    if (city.length < 3 || city.length > 255) return false;

    // Province should be between 5 and 255 characters
    const province = rowEl.querySelector('input[name=\'province\']').value;
    if (province.length < 5 || province.length > 255) return false;

    // Postal Code should be 6 characters and match the format A1A 1A1 (optional space in the middle)
    const postal_code = rowEl.querySelector('input[name=\'postal_code\']').value;
    const regex = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ ]?\d[ABCEGHJ-NPRSTV-Z]\d$/;
    if (!postal_code.match(regex)) return false;


    return true;
}

function validateBillingInput(rowEl)
{
    // cardNum should be 16 digits
    const cardNum = rowEl.querySelector('input[name=\'card_num\']').value;
    let regex = /^[0-9]{16}$/;
    if (!cardNum.match(regex)) return false;

    // cardName should be between 1 and 255 characters
    const cardName = rowEl.querySelector('input[name=\'card_name\']').value;
    if (cardName.length < 1 || cardName.length > 255) return false;

    // Expiry date should be MM/YY, with an optional space on both sides of the /
    const expDate = rowEl.querySelector('input[name=\'exp_date\']').value;
    regex = /^((0[1-9])|(1[0-2]))[ ]?\/[ ]?[0-9]{2}$/;
    if (!expDate.match(regex)) return false;

    // cvv should be 3 digits
    const cvv = rowEl.querySelector('input[name=\'cvv\']').value;
    regex = /^[0-9]{3}$/;
    if (!cvv.match(regex)) return false;

    return true;
}

// After a new record is added, some things need to be updated in the markup
function userUpdateNewRowData(rowEl, btnEl, responseId, recordType, username)
{
    // Set the element ID based on the primary key of the new record
    rowEl.setAttribute('id', responseId);

    // Remove the grey background
    rowEl.classList.remove('bg-secondary');

    // // Show the create record button again
    // btnEl.classList.remove('d-none');

    // Replace the buttons with the 3 modify record action buttons
    const buttonsTd = rowEl.lastElementChild;
    buttonsTd.innerHTML = `
        <button type="button" class="btn-empty delete-record"
                onclick="userDeleteRecord('${responseId}', ${recordType})">
            <img src="../static/close_black.svg"
                 alt="Delete Record"
                 class="delete_icon"/>
        </button>
        <button type="button" class="btn-empty toggle-edit-record"
                onclick="userToggleRecordEditable('${responseId}')">
            <img src="../static/edit_black.svg"
                 alt="Edit Record"
                 class="edit_icon"/>
        </button>
        <button type="button" class="btn-empty confirm-edit-record"
                onclick="userConfirmRecordEdit('${responseId}', ${recordType})">
            <img src="../static/check_black.svg"
                 alt="Confirm Edit"
                 class="confirm_icon"/>
        </button>
    `;

    checkRecordCount(username, recordType, btnEl);

}

function checkRecordCount(username, recordType, btnEl)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            const jsonResponse = JSON.parse(xhttp.responseText);
            if (xhttp.status === 200) {
                if (jsonResponse['can_add']) {
                    btnEl.classList.remove('d-none');
                } else {
                    btnEl.className = 'btn btn-primary ms-2 d-none';
                }
                console.log('check_record_count response: ' + jsonResponse);
            } else if (xhttp.status === 500) {
                console.log('check_record_count error: ' + jsonResponse);
            }
        }
    };

    // Send a request
    const url = '../services/check_record_count.php';
    const jsonObj = { username: username, record_type: recordType };


    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify(jsonObj));
    } else {
        console.error('Cannot delete record: invalid record type.');
    }

}
