document.getElementById('toggleSidebarMobile').addEventListener('click', function () {
    document.querySelector('#toggleSidebarMobileHamburger').classList.toggle('hidden');
    document.querySelector('#toggleSidebarMobileClose').classList.toggle('hidden');
    document.querySelector('#sidebar').classList.toggle('hidden');
});

document.getElementById('button-arrow-profile').addEventListener('click', function () {
    document.querySelector('#side-menu-profile').classList.toggle('hidden');
});
document.getElementById('toggle-dropdown').addEventListener('click', function () {
    document.querySelector('#drop-down').classList.toggle('hidden');
    document.querySelector('#arrow-dropdown-open').classList.toggle('hidden');
    document.querySelector('#arrow-dropdown-close').classList.toggle('hidden');
});
