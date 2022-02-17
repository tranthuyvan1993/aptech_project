var brandButton = document.getElementById('brandButton');
var brandMenuContainer = document.getElementById('brandMenuContainer');
var brandMenu = document.getElementById('brandMenu');
var brandMenuCloseButton = document.getElementById('brandMenuCloseButton');

function toggleBrandMenu() {
    console.log('toggle');
    if (brandMenuContainer.style.width == '100%') {
        closeBrandMenu();
    } else {
        openBrandMenu();
    }
}

function clickLocation(event) {
    var clickX = event.clientX;

    if (clickX > 480) {
        closeBrandMenu();
    }
}

brandMenuContainer.addEventListener('click', clickLocation);

function openBrandMenu() {
    brandButton.classList.add('navbar__link--is-active');
    brandMenuContainer.style.width = '100%';
    brandMenuContainer.style.left = '0';
}

function closeBrandMenu() {
    brandButton.classList.remove('navbar__link--is-active');
    brandMenuContainer.style.width = '0';
    brandMenuContainer.style.left = '-1600px'
}