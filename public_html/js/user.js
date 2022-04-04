// TODO
function deleteRecord(rowId, recordType)
{
    const rowEl = document.getElementById(rowId);

    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                rowEl.remove();
                console.log('deleteRecord response: ' + xhttp.responseText);
            } else if (xhttp.status === 500) {
                console.log('deleteRecord error: ' + xhttp.responseText);
            }
        }
    };

    // Send a request
    let url = '';
    if (recordType === 0) {
        url = '../static/delete_shipping.php';
    } else if (recordType === 1) {
        url = '../static/delete_billing.php';
    }


    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify({ pk: rowId }));
    } else {
        console.error('Cannot delete record: invalid record type.');
    }
}

// TODO
function toggleRecordEditable(rowId)
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

// TODO
function confirmRecordEdit(rowId, recordType)
{
    const rowEl = document.getElementById(rowId);

    // First, validate the input
    if (recordType === 0 && !validateAccountInput(rowEl, false)) {
        console.log('Invalid account input.');
        toggleRecordEditable(rowId);
        return;
    } else if (recordType === 1 && !validateProductInput(rowEl)) {
        console.log('Invalid product input.');
        toggleRecordEditable(rowId);
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
        updateRecord(rowId, changedFields, recordType);
    }
}

// TODO
function updateRecord(rowId, changedFields, recordType)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                console.log('updateRecord response: ' + xhttp.responseText);
                if (recordType === 0 && 'username' in changedFields) {
                    updateRowData(rowId, changedFields['username'], 0);
                }
                // NOTE: The primary key of the products cannot be changed since "id" is not a field in the UI table.
                // Hence, we don't need to call updateRowData to make fixes (which only happens when an admin user
                // edits a primary key
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
    if (recordType === 0) {
        url = '../static/update_account.php';
    } else if (recordType === 1) {
        url = '../static/update_product.php';
    }

    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify(jsonObj));
    } else {
        console.error('Cannot update record: invalid record type.');
    }
}

// TODO
// If the primary key of a record is changed, some fields within that row on the UI need to be edited
function updateRowData(rowId, newRowId)
{
    const rowEl = document.getElementById(rowId);
    rowEl.id = newRowId;
    const buttonsTd = rowEl.lastElementChild;
    buttonsTd.querySelector('.delete-record').onclick = () => deleteRecord(newRowId, 0);
    buttonsTd.querySelector('.toggle-edit-record').onclick = () => toggleRecordEditable(newRowId);
    buttonsTd.querySelector('.confirm-edit-record').onclick = () => confirmRecordEdit(newRowId, 0);
}

// TODO
function createNewShippingRow()
{
    // Don't let the admin click create account before finishing an account they are already creating.
    // NOTE: this should never happen since the button should be hidden once clicked. This check is made just in case.
    if (document.getElementById('new-shipping') !== null) {
        console.log('Already creating new shipping record.');
        return;
    }

    // Hide the button (show again by removing the class)
    document.getElementById('create-shipping-info-btn').classList.add('d-none');

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
                    onclick="cancelAddNewRecord(0)">
                <img src="../static/close_black.svg"
                     alt="Cancel"
                     class="delete_icon"/>
            </button>
            <button type="button" class="btn-empty confirm-add-record"
                    onclick="confirmAddNewRecord(0)">
                <img src="../static/check_black.svg"
                     alt="Confirm"
                     class="confirm_icon"/>
            </button>
        </td>
    `;
    tbody.appendChild(newShippingRow);
}

// TODO
function createNewBillingRow()
{
    // Don't let the admin click create account before finishing an account they are already creating.
    // NOTE: this should never happen since the button should be hidden once clicked. This check is made just in case.
    if (document.getElementById('new-billing') !== null) {
        console.log('Already creating new billing record.');
        return;
    }

    // Hide the button (show again by removing the class)
    document.getElementById('create-billing-info-btn').classList.add('d-none');

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
                    onclick="cancelAddNewRecord(1)">
                <img src="../static/close_black.svg"
                     alt="Cancel"
                     class="delete_icon"/>
            </button>
            <button type="button" class="btn-empty confirm-add-record"
                    onclick="confirmAddNewRecord(1)">
                <img src="../static/check_black.svg"
                     alt="Confirm"
                     class="confirm_icon"/>
            </button>
        </td>
    `;
    tbody.appendChild(newBillingRow);
}

// TODO
function cancelAddNewRecord(recordType)
{
    let rowEl;
    let btnEl;
    if (recordType === 0) {
        rowEl = document.getElementById('new-shipping');
        btnEl = document.getElementById('create-shipping-info-btn');
    } else if (recordType === 1) {
        rowEl = document.getElementById('new-billing');
        btnEl = document.getElementById('create-billing-info-btn');
    } else {
        return;
    }

    // Remove the row and show the button
    rowEl.remove();
    btnEl.classList.remove('d-none');
}

// TODO
function confirmAddNewRecord(recordType)
{
    let rowEl;
    let btnEl;
    let url;
    // Validate input
    if (recordType === 0) {
        rowEl = document.getElementById('new-shipping');
        btnEl = document.getElementById('create-shipping-info-btn');
        if (validateShippingInput(rowEl, true)) {
            url = '../static/add_shipping.php';
        } else {
            console.log('Invalid shipping input.');
            return;
        }
    } else if (recordType === 1) {
        rowEl = document.getElementById('new-billing');
        btnEl = document.getElementById('create-billing-info-btn');
        if (validateProductInput(rowEl)) {
            url = '../static/add_billing.php';
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
    let fields = {};
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
                updateNewRowData(rowEl, btnEl, jsonResponse['id'], recordType);
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

// TODO
function validateShippingInput(rowEl, isNewAccount)
{
    // Street Number should be between 0 and 255 characters
    const street_num = rowEl.querySelector('input[name=\'street_num\']').value;
    if (street_num.length < 0 || street_num.length > 255) return false;

    // Street Name should be between 5 and 255 characters
    const street_name = rowEl.querySelector('input[name=\'street_name\']').value;
    if (street_name.length < 5 || street_num.length > 255) return false;

    // City should be between 3 and 255 characters
    const city = rowEl.querySelector('input[name=\'city\']').value;
    if (city.length < 3 || city.length > 255) return false;

    // Province should be between 5 and 255 characters
    const province = rowEl.querySelector('input[name=\'province\']').value;
    if (province.length < 5 || province.length > 255) return false;

    // Postal Code should be 6 characters and match the format A1A 1A1
    const postal_code = rowEl.querySelector('input[name=\'postal_code\']').value;
    const regex = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ ]?\d[ABCEGHJ-NPRSTV-Z]\d$/
    if (!postal_code.match(regex)) return false;


    return true;
}

// TODO
function validateBillingInput(rowEl)
{
    // name should be <= 255 characters
    const name = rowEl.querySelector('input[name=\'product_name\']').value;
    if (name.length < 0 || name.length > 255) return false;

    // description should be <= 1024 characters
    const description = rowEl.querySelector('input[name=\'description\']').value;
    if (description.length < 0 || description.length > 1024) return false;

    // imageURL should at least contain https://a.ca (12 chars)
    // I know this check is bad, but it's better than nothing (:
    // imageURL should also be less than 100 characters
    const imageURL = rowEl.querySelector('input[name=\'image_url\']').value;
    if (imageURL.length < 12 || imageURL.length > 100) return false;

    // price should be a decimal number with at most 6 digits and 2 decimal places (i.e., in SQL: DECIMAL(6,2))
    // So: price should be non-negative and < 10000
    const price = parseFloat(rowEl.querySelector('input[name=\'price\']').value);
    if (isNaN(price) || price < 0 || price > 9999) return false;

    return true;
}

// TODO
// After a new record is added, some things need to be updated in the markup
function updateNewRowData(rowEl, btnEl, responseId, recordType)
{
    // Set the element ID based on the primary key of the new record
    rowEl.setAttribute('id', responseId);

    // Remove the grey background
    rowEl.classList.remove('bg-secondary');

    // Show the create record button again
    btnEl.classList.remove('d-none');

    // Replace the buttons with the 3 modify record action buttons
    const buttonsTd = rowEl.lastElementChild;
    buttonsTd.innerHTML = `
        <button type="button" class="btn-empty delete-record"
                onclick="deleteRecord('${responseId}', ${recordType})">
            <img src="../static/close_black.svg"
                 alt="Delete Record"
                 class="delete_icon"/>
        </button>
        <button type="button" class="btn-empty toggle-edit-record"
                onclick="toggleRecordEditable('${responseId}')">
            <img src="../static/edit_black.svg"
                 alt="Edit Record"
                 class="edit_icon"/>
        </button>
        <button type="button" class="btn-empty confirm-edit-record"
                onclick="confirmRecordEdit('${responseId}', ${recordType})">
            <img src="../static/check_black.svg"
                 alt="Confirm Edit"
                 class="confirm_icon"/>
        </button>
    `;
}
