$(document).ready(function () {
  const input = $('#pjax-search-input');
  input.on('input', (e) => {
    $.pjax.reload({
        container: "#pjax-search-results",
        timeout: 1000,
        replace: false,
        data: {
          search: e.target.value,
        }
    });
  });
});