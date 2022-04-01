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
        url = '../static/delete_account.php';
    } else if (recordType === 1) {
        url = '../static/delete_product.php';
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
    for (let i = 0; i < 4; ++i) {
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
    // First, make all the fields readonly and check for changes
    const rowEl = document.getElementById(rowId);
    const tds = rowEl.children;
    let changedFields = {};
    for (let i = 0; i < 4; ++i) {
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

// If the primary key of a record is changed, some fields within that row on the UI need to be edited
function updateRowData(rowId, newRowId)
{
    const rowEl = document.getElementById(rowId);
    rowEl.id = newRowId;
    const buttonsTd = rowEl.children[4];
    buttonsTd.querySelector('.delete-record').onclick = () => deleteRecord(newRowId, 0);
    buttonsTd.querySelector('.toggle-edit-record').onclick = () => toggleRecordEditable(newRowId);
    buttonsTd.querySelector('.confirm-edit-record').onclick = () => confirmRecordEdit(newRowId, 0);
}
