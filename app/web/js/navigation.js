$(document).ready(function () {
  const drawer = $('#navigation-mobile-drawer');
  const button = $('#navigation-mobile-toggle');
  const navigation = $('#navigation-mobile');
  const content = $('main[role="main"]');
  const body = $('body');

  const applyLayout = () => {
    const width = $(window).width();
    const isDrawerShown = width < 768;
    if (isDrawerShown) {
      content.css({
        paddingTop: navigation.outerHeight()
      });
      drawer.css({
        left: -drawer.outerWidth()
      });
    } else {
      content.removeAttr('style');
      drawer.removeAttr('style');
    }
  };

  const closeDrawer = () => {
    drawer.css({
      left: -drawer.outerWidth()
    });
    drawer.removeClass('open');
  };

  const createOverlay = () => {
     $('body').append('<div id="drawer-overlay" class="drawer-overlay"></div>');
    body.on('click', '#drawer-overlay', () => {
      const overlay = $('#drawer-overlay');
      overlay.remove();
      closeDrawer();
    })
  };

  const openDrawer = () => {
    drawer.removeAttr('style');
    drawer.addClass('open');
  };

  button.click(() => {
    createOverlay();
    openDrawer();
  });
  applyLayout();
  $(window).resize(function () {
    applyLayout();
  });
});