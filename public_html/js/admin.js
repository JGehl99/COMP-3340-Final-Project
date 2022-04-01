function deleteAccount(username)
{
    const rowEl = document.getElementById(username);

    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                rowEl.remove();
                console.log('deleteAccount response: ' + xhttp.responseText);
            } else if (xhttp.status === 500) {
                console.log('deleteAccount error: ' + xhttp.responseText);
            }
        }
    };

    // Send a request
    xhttp.open('POST', `../static/delete_account.php`);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xhttp.send(JSON.stringify({ username }));
}

function toggleAccountEditable(username)
{
    const rowEl = document.getElementById(username);
    const tds = rowEl.children;
    const editable = !tds[0].firstElementChild.hasAttribute('readonly');
    for (let td of tds) {
        const inputEl = td.firstElementChild;
        if (editable) {
            inputEl.setAttribute('readonly', '');
            // Reset input to its old value, since the edit was not confirmed
            inputEl.value = inputEl.getAttribute('value');
        } else {
            inputEl.removeAttribute('readonly');
        }
    }
}

function confirmAccountEdit(username)
{
    // First, make all the fields readonly and check for changes
    const rowEl = document.getElementById(username);
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

    // If any fields have been changed, send them to updateAccount()
    const accountChanged = Object.keys(changedFields).length !== 0;
    if (accountChanged) updateAccount(username, changedFields);
}

function updateAccount(username, changedFields)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                console.log('updateAccount response: ' + xhttp.responseText);
                if ('username' in changedFields) {
                    updateRowData(username, changedFields['username']);
                }
            } else if (xhttp.status === 500) {
                console.log('updateAccount error: ' + xhttp.responseText);
            }
        }
    };

    // Send a request
    const jsonObj = {
        old_username: username,
        ...changedFields,
    };

    xhttp.open('POST', `../static/update_account.php`);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xhttp.send(JSON.stringify(jsonObj));
}

// If the username of an account is changed, some fields within that row such as onclicks have to be edited
function updateRowData(username, newUsername)
{
    const rowEl = document.getElementById(username);
    rowEl.id = newUsername;
    const buttonsTd = rowEl.children[4];
    buttonsTd.querySelector('.delete-account').onclick = () => deleteAccount(newUsername);
    buttonsTd.querySelector('.toggle-edit-account').onclick = () => toggleAccountEditable(newUsername);
    buttonsTd.querySelector('.confirm-edit-account').onclick = () => confirmAccountEdit(newUsername);
}
