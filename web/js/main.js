function dropdownActive() {
    const items = $('.dropdown-item-link, .nav-link');
    const { pathname } = window.location;
    items.each(function (i, v) {
        const href = $(v).attr('href');
        if (href === pathname) {
            $(v).addClass('active');
        }
    });
}

function addPadding() {
    const height = $('.navbar').outerHeight();
    $('.wrapper').css({
        paddingTop: height + 15
    });
}

$(document).ready(function () {
    dropdownActive();
    // addPadding();
});