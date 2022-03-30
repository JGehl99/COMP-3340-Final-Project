let darkSwitch = document.getElementById("darkSwitch")

window.addEventListener("load", (
    function () {
        if (darkSwitch) {
            initiate();
            darkSwitch.addEventListener("change", (
                function () {
                    reset();
                }
            ))
        }
    }
));

function initiate()
{
    let select = localStorage.getItem("data-theme");

    if(select){
        document.body.setAttribute("data-theme", "dark")
    }
        // !==null && localStorage.getItem("darkSwitch") === "dark";
    darkSwitch.checked = select;

}

function reset() {
    if (darkSwitch.checked) {
        document.body.setAttribute("data-theme", "dark");
        localStorage.setItem("data-theme", 'dark')
    } else {
        document.body.removeAttribute("data-theme");
        localStorage.removeItem("data-theme")
    }
}

