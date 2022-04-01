function deleteAccount(username)
{
    const rowEl = document.getElementById(username);
    console.log(rowEl);
}

function toggleAccountEditable(username)
{
    const rowEl = document.getElementById(username);
    const tds = rowEl.children;
    const editable = !tds[0].firstElementChild.hasAttribute('readonly');
    for (let td of tds) {
        if (editable) {
            td.firstElementChild.setAttribute('readonly', '');
        } else {
            td.firstElementChild.removeAttribute('readonly');
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
        const input = tds[i].firstElementChild;
        input.setAttribute('readonly', '');

        // Checking if any values have changed
        if (input.value !== input.getAttribute('value')) {
            changedFields[input.getAttribute('name')] = input.value;
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