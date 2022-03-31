function refreshCSS() {
    let stylesheet = document.getElementById('theme-stylesheet');
    let theme = 'light';
    if (stylesheet != null) {
        if (/\b(dark)\b/.test(stylesheet.getAttribute('href'))) {
            stylesheet.setAttribute("href", "../css/light.css");
            document.getElementById("dark_mode_icon").src = "../static/light_icon.svg";
            document.getElementById("btn-btt-img").src = "../static/arrow_upward_white_24dp.svg";
            document.getElementById("navbar_icon").src = "../static/hamburger_black.svg";
            theme = 'light';
        } else if (/\b(light)\b/.test(stylesheet.getAttribute('href'))) {
            stylesheet.setAttribute("href", "../css/dark.css");
            document.getElementById("dark_mode_icon").src = "../static/dark_icon.svg";
            document.getElementById("btn-btt-img").src = "../static/arrow_upward_black_24dp.svg";
            document.getElementById("navbar_icon").src = "../static/hamburger_white.svg";
            theme = 'dark';
        }
        // Create an XMLHttpRequest object
        const xhttp = new XMLHttpRequest();

        // Define a callback function
        xhttp.onload = () => {
            if (xhttp.readyState === 4) {
                if (xhttp.status === 200) {
                    if (xhttp.responseText === 'dark') {
                        document.getElementById("darkSwitch").clicked = true;
                    } else {
                        document.getElementById("darkSwitch").clicked = true;
                    }
                }
            }
        }

        // Send a request
        xhttp.open("GET", "../static/process_theme.php?theme=" + theme);
        xhttp.setRequestHeader("Content-type", "text/plain");
        xhttp.setRequestHeader('Accept', 'text/plain');
        xhttp.send();
    }
}