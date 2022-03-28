var darkSwitch = document.getElementById("darkSwitch")

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
    let select = localStorage.getItem("darkSwitch")!==null && localStorage.getItem("darkSwitch") === "dark";
    darkSwitch.checked = select;
    select? document.body.setAttribute("data-theme", "dark") : document.body.removeAttribute("data-theme");
}

function reset() {
    if (darkSwitch.checked) {
        document.body.setAttribute("data-theme", "dark");
        localStorage.removeItem("data-theme");
    } else {
        document.body.removeAttribute("data-theme");
        localStorage.removeItem("darkSwitch")
    }
}