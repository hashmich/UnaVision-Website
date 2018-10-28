
$(document).ready(function() {
    console.log('foo');
    adjustMenuHeight();
    $(window).resize(function() {
        adjustMenuHeight();
    });
});



function adjustMenuHeight() {
    var menuHeight = $('#menu-container').height();
    $('#content').css('margin-top', menuHeight + 50 + 'px');
}