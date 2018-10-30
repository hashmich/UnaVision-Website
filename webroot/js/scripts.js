
$(document).ready(function() {
    //adjustMenuHeight();
    $(window).resize(function() {
        //adjustMenuHeight();
    });

    $(".lang-select").click(function() {
        setLanguage($(this).attr("value"));
    });
});



function adjustMenuHeight() {
    var menuHeight = $('#menu-container').height();
    $('#content').css('margin-top', menuHeight + 50 + 'px');
}

function setLanguage(lang) {
    // expiry in 14 days
    var expiry = new Date(Date.now() + 12096e5);
    document.cookie = "language="+lang+"; expires="+expiry.toUTCString()+";";
    // forced reload, bypassing caches
    window.location.reload(true);
}