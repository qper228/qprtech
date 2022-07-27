function activeLinks() {
    const items = $('.nav-link');
    const { pathname } = window.location;
    items.each(function (i, v) {
        const href = $(v).attr('href');
        if (pathname.includes(href)) {
            $(v).addClass('active');
        }
    });
}


$(document).ready(function () {
    $('.preloader').hide();
    activeLinks();
});