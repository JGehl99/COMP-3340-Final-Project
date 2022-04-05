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
        url = '../services/delete_account.php';
    } else if (recordType === 1) {
        url = '../services/delete_product.php';
    }

    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify({ pk: rowId }));
    } else {
        console.error('Cannot delete record: invalid record type.');
    }
}

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
        url = '../services/update_account.php';
    } else if (recordType === 1) {
        url = '../services/update_product.php';
    }

    if (url.length > 0) {
        xhttp.open('POST', url);
        xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhttp.send(JSON.stringify(jsonObj));
    } else {
        console.error('Cannot update record: invalid record type.');
    }
}

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

function createNewAccountRow()
{
    // Don't let the admin click create account before finishing an account they are already creating.
    // NOTE: this should never happen since the button should be hidden once clicked. This check is made just in case.
    if (document.getElementById('new-account') !== null) {
        console.log('Already creating new account.');
        return;
    }

    // Hide the button (show again by removing the class)
    document.getElementById('create-account-btn').classList.add('d-none');

    const tbody = document.getElementById('account-tbody');
    const newAccountRow = document.createElement('tr');
    newAccountRow.setAttribute('id', 'new-account');
    newAccountRow.className = 'bg-secondary';
    newAccountRow.innerHTML = `
        <td>
            <input type="text"
                   name="username"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="password"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="account_type"
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
    tbody.appendChild(newAccountRow);
}

function createNewProductRow()
{
    // Don't let the admin click create account before finishing an account they are already creating.
    // NOTE: this should never happen since the button should be hidden once clicked. This check is made just in case.
    if (document.getElementById('new-product') !== null) {
        console.log('Already creating new product.');
        return;
    }

    // Hide the button (show again by removing the class)
    document.getElementById('create-product-btn').classList.add('d-none');

    const tbody = document.getElementById('product-tbody');
    const newProductRow = document.createElement('tr');
    newProductRow.setAttribute('id', 'new-product');
    newProductRow.className = 'bg-secondary';
    newProductRow.innerHTML = `
        <td>
            <input type="text"
                   name="product_name"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="description"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="image_url"
                   class="form-control"
                   value=""/>
        </td>
        <td>
            <input type="text"
                   name="price"
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
    tbody.appendChild(newProductRow);
}

function cancelAddNewRecord(recordType)
{
    let rowEl;
    let btnEl;
    if (recordType === 0) {
        rowEl = document.getElementById('new-account');
        btnEl = document.getElementById('create-account-btn');
    } else if (recordType === 1) {
        rowEl = document.getElementById('new-product');
        btnEl = document.getElementById('create-product-btn');
    } else {
        return;
    }

    // Remove the row and show the button
    rowEl.remove();
    btnEl.classList.remove('d-none');
}

function confirmAddNewRecord(recordType)
{
    let rowEl;
    let btnEl;
    let url;
    // Validate input
    if (recordType === 0) {
        rowEl = document.getElementById('new-account');
        btnEl = document.getElementById('create-account-btn');
        if (validateAccountInput(rowEl, true)) {
            url = '../services/add_account.php';
        } else {
            console.log('Invalid account input.');
            return;
        }
    } else if (recordType === 1) {
        rowEl = document.getElementById('new-product');
        btnEl = document.getElementById('create-product-btn');
        if (validateProductInput(rowEl)) {
            url = '../services/add_product.php';
        } else {
            console.log('Invalid product input.');
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

function validateAccountInput(rowEl, isNewAccount)
{
    // Username should be between 8 and 255 characters
    const username = rowEl.querySelector('input[name=\'username\']').value;
    if (username.length < 8 || username.length > 255) return false;

    // Password should be at least 8 characters
    const passwordEl = rowEl.querySelector('input[name=\'password\']');
    const password = passwordEl.value;
    if (password.length < 8) {
        // If the account is an existing account, and the password value has not changed we do not validate it
        // Otherwise, we need to return false if the length < 8
        if ((!isNewAccount && password !== passwordEl.getAttribute('value'))
            || isNewAccount) return false;
    }

    // Account type should be a non-negative single digit integer
    const accountType = parseInt(rowEl.querySelector('input[name=\'account_type\']').value);
    if (isNaN(accountType) || accountType < 0 || accountType > 9) return false;

    return true;
}

function validateProductInput(rowEl)
{
    // name should be <= 255 characters
    const name = rowEl.querySelector('input[name=\'product_name\']').value;
    if (name.length < 0 || name.length > 255) return false;

    // description should be <= 1024 characters
    const description = rowEl.querySelector('input[name=\'description\']').value;
    if (description.length < 1 || description.length > 1024) return false;

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
                 alt="Delete Account"
                 class="delete_icon"/>
        </button>
        <button type="button" class="btn-empty toggle-edit-record"
                onclick="toggleRecordEditable('${responseId}')">
            <img src="../static/edit_black.svg"
                 alt="Edit Account"
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
