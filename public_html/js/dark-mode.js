window.onload = getTheme;

function getTheme()
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                console.log('getTheme() Response: ' + xhttp.responseText);
                document.getElementById('darkSwitch').checked = xhttp.responseText === 'dark';
            }
        }
    };

    // Send a request
    xhttp.open('GET', '../services/process_theme.php?get=true');
    xhttp.setRequestHeader('Content-type', 'text/plain');
    xhttp.setRequestHeader('Accept', 'text/plain');
    xhttp.send();
}

function setTheme()
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    let newTheme = '';
    if (document.getElementById('darkSwitch').checked) {
        console.log('Switch is checked');
        newTheme = 'dark';
    } else {
        console.log('Switch is not checked');
        newTheme = 'light';
    }

    // Define a callback function
    xhttp.onload = () => {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                console.log('setTheme() Response: ' + xhttp.responseText);
                if (xhttp.responseText === 'dark') {
                    document.getElementById('dark_mode_icon').src = '../static/dark_icon.svg';
                    document.getElementById('btn-btt-img').src = '../static/arrow_upward_black.svg';
                    document.getElementById('navbar_icon').src = '../static/hamburger_white.svg';

                    let stylesheet = document.getElementById('theme-stylesheet');
                    stylesheet.setAttribute('href', '../css/dark.css');
                } else {
                    document.getElementById('dark_mode_icon').src = '../static/light_icon.svg';
                    document.getElementById('btn-btt-img').src = '../static/arrow_upward_white.svg';
                    document.getElementById('navbar_icon').src = '../static/hamburger_black.svg';

                    let stylesheet = document.getElementById('theme-stylesheet');
                    stylesheet.setAttribute('href', '../css/light.css');
                }
            }
        }
    };

    // Send a request
    xhttp.open('GET', '../services/process_theme.php?theme=' + newTheme);
    xhttp.setRequestHeader('Content-type', 'text/plain');
    xhttp.setRequestHeader('Accept', 'text/plain');
    xhttp.send();
}