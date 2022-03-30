//JS for button that appears when user scrolls past 20px, button scrolls back to top of page.
let scrollButton = document.getElementById("btn-btt");

window.onscroll = function (){
    scroll();
}


function scroll(){
    if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20){
        scrollButton.style.display = "block";
    }else{
        scrollButton.style.display = "none";
    }
}

scrollButton.addEventListener("click", scrollTop);

function scrollTop(){
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}