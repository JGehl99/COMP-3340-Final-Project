let darkSwitch = document.getElementById('darkSwitch');

darkSwitch.checked = localStorage.getItem('data-theme') === 'dark';

darkSwitch.checked ? applyDarkMode() : applyLightMode();

darkSwitch.onclick = () => {
    if (darkSwitch.checked) {
        applyDarkMode();
        localStorage.setItem('data-theme', 'dark');
    } else {
        applyLightMode();
        localStorage.setItem('data-theme', 'light');
    }
};

function applyDarkMode()
{
    // If dark mode selected:

    // Change all bg-lights to bg-dark
    document.querySelectorAll('[class*=\'bg-light\']').forEach((e) => {
        e.className = e.className.replace(/bg-light/g, 'bg-dark');
    });

    // Change all bg-blacks to bg-whites
    document.querySelectorAll('[class*=\'bg-white\']').forEach((e) => {
        e.className = e.className.replace(/bg-white/g, 'bg-vdark');
    });

    // Change all text-darks to text-white
    document.querySelectorAll('[class*=\'text-dark\']').forEach((e) => {
        e.className = e.className.replace(/text-dark/g, 'text-white');
    });

    // Change all link-darks to link-white
    document.querySelectorAll('[class*=\'link-dark\']').forEach((e) => {
        e.className = e.className.replace(/link-dark/g, 'link-light');
    });

    // Set icons to other version
    document.getElementById('dark_mode_icon').src = '../static/dark_icon.svg';
    document.getElementById('navbar_icon').src = '../static/hamburger_white.svg';
    document.getElementById('btn-btt-img').src = '../static/arrow_upward_black_24dp.svg';
    document.getElementById('btn-btt').classList.replace('btn-dark', 'btn-light');
}

function applyLightMode()
{
    // If dark mode not selected

    // Change all bg-darks to bg-light
    document.querySelectorAll('[class*=\'bg-dark\']').forEach((e) => {
        e.className = e.className.replace(/bg-dark/g, 'bg-light');
    });

    // Change all bg-whites to bg-blacks
    document.querySelectorAll('[class*=\'bg-vdark\']').forEach((e) => {
        e.className = e.className.replace(/bg-vdark/g, 'bg-white');
    });

    // Change all text-whites to text-dark
    document.querySelectorAll('[class*=\'text-white\']').forEach((e) => {
        e.className = e.className.replace(/text-white/g, 'text-dark');
    });

    // Change all text-whites to text-dark
    document.querySelectorAll('[class*=\'link-light\']').forEach((e) => {
        e.className = e.className.replace(/link-light/g, 'link-dark');
    });

    // Set icons to other version
    document.getElementById('dark_mode_icon').src = '../static/light_icon.svg';
    document.getElementById('navbar_icon').src = '../static/hamburger_black.svg';
    document.getElementById('btn-btt-img').src = '../static/arrow_upward_white_24dp.svg';
    document.getElementById('btn-btt').classList.replace('btn-light', 'btn-dark');
}
