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
    if (window.innerWidth >= 768) {
        $('.wrapper').css({
            paddingTop: height
        });
    }
 }

$(document).ready(function () {
    dropdownActive();
    addPadding();

    // const blogSortBtn = $('.blog-dropdown');
    // blogSortBtn.on('click', '.dropdown-item', () => {
    //     console.log('clock')
    // })
});