window.onload = () => {
    let serverStatus = document.getElementById("server_status");
    let dbStatus = document.getElementById("db_status");

    // Create an XMLHttpRequest object
    const xHttpServer = new XMLHttpRequest();

    // Define a callback function
    xHttpServer.onload = () => {
        if (xHttpServer.readyState === 4) {
            if (xHttpServer.status === 200) {
                console.log(xHttpServer.responseText)
                serverStatus.classList.replace("text-dark", "text-success");
                serverStatus.textContent = "OPERATIONAL";
            } else{
                serverStatus.classList.replace("text-dark", "text-danger");
                serverStatus.textContent = "ERROR";
            }
        }
    }

    // Send a request
    xHttpServer.open("GET", "https://oldchicken.myweb.cs.uwindsor.ca/static/ping.php?type=server");
    xHttpServer.setRequestHeader("Content-type", "text/plain");
    xHttpServer.setRequestHeader('Accept', 'text/plain');
    xHttpServer.send();

    // Create an XMLHttpRequest object
    const xHttpDB = new XMLHttpRequest();

    // Define a callback function
    xHttpDB.onload = () => {
        if (xHttpDB.readyState === 4) {
            if (xHttpDB.status === 200) {
                console.log(xHttpDB.responseText)
                dbStatus.classList.replace("text-dark", "text-success");
                dbStatus.textContent = "OPERATIONAL";
            } else{
                dbStatus.classList.replace("text-dark", "text-danger");
                dbStatus.textContent = "ERROR";
            }
        }
    }

    // Send a request
    xHttpDB.open("GET", "https://oldchicken.myweb.cs.uwindsor.ca/static/ping.php?type=db");
    xHttpDB.setRequestHeader("Content-type", "text/plain");
    xHttpDB.setRequestHeader('Accept', 'text/plain');
    xHttpDB.send();
}
