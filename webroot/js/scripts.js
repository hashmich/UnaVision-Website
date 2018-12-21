
var map;

$(document).ready(function() {
    //adjustMenuHeight();
    $(window).resize(function() {
        //adjustMenuHeight();
    });

    $(".lang-select").click(function() {
        setLanguage($(this).attr("value"));
    });

    var activeLogo = $('a.logo.active');
    var activeSubmenu = $('.active.submenu');

    $('a.logo').hover(function(event) {
        toggleMenu(this);
    });
    // for touch-devices
    $('a.logo').click(function () {
        toggleMenu(this);
    });

    $('#menu').mouseleave(function() {
        menuRevert(activeSubmenu, activeLogo);
    });

    if($('#map').length) {
        var villages = [
            {
                name: 'Herzershof, Germany',
                point: [14.555871, 52.539489],
                description: 'Herzershof 10,<br>15328 Küstriner Vorland,<br>Germany',
                email: 'oderbruch@unavision.eu',
                status: 'existing'
            },
            {
                name: 'Gircha, Ethiopia',
                point: [37.560944, 6.304139],
                description: 'A place of about 90 hectare, named "Gircha" is available in the region Cencia, ' +
                    'north of Arba Minch. A design challenge has been held in 2018 in cooperation ' +
                    'with Arba Minch University. Planning and stakeholder agreements are under way.',
                email: 'ethiopia@unavision.eu',
                status: 'founding'
            },
            {
                name: 'Istog, Kosovo',
                point: [20.469848, 42.784385],
                description: 'Near the town of Istog, a 50 hectare land has been identified. ' +
                    'The municipality of Istog agreed to make land available and provide additional resources ' +
                    'over the next decade to establish the UnaVillage region. ' +
                    'Some entrepreneurs from Istog and Kosovo support the creation of the UnaVillage region' +
                    ' with their resources and networks.',
                email: 'kosovo@unavision.eu',
                status: 'founding'
            },
            {
                name: 'Opština Tearce, Macedonia',
                point: [21.053748, 42.076607],
                description: 'Around Tearce, in a beautyful mountain region, a network has formed' +
                    ' to foster the UnaVillage initiative. ',
                email: 'macedonia@unavision.eu',
                status: 'founding'
            }
        ];
        mapboxgl.accessToken = 'pk.eyJ1IjoiaGFzaG1pY2giLCJhIjoiY2pwNGlyajN6MDQyNjNxcXVtMGt4ajBjYiJ9.jXcv_r7YL0rxLOlhloZwog';
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/hashmich/cjp4hjxpq3upp2rt834hy0bhv',
            center: [10, 36],
            zoom: 0.96
        });
        map.scrollZoom.disable();
        $('#map').mouseleave(function() {
            map.scrollZoom.disable();
        });
        $('#map').click(function() {
            map.scrollZoom.enable({ around: 'center' });
        });

        for(var i = 0; i < villages.length; i++) {
            var el = document.createElement('div');
            el.id = 'villages-' + i;
            if(villages[i].status == 'existing') el.className = 'marker existing';
            else el.className = 'marker founding';
            var popup = new mapboxgl.Popup({ offset: 25 });

            var marker = new mapboxgl.Marker(el).setLngLat(villages[i].point)
                .setPopup(popup.setHTML(villages[i].description))
                .addTo(map);
        }
    }


    if($('.sidebar').length && $('.accordeon').length) {
        sidebarNavigation('.flex-columns', '.sidebar', '.accordeon');
    }


    if($('#notification').length) {
        $('#notification').slideDown('fast').delay(8000).fadeOut('slow');
    }


});


function toggleMenu(currentLogo) {
    if(!$(currentLogo).hasClass('active')) {
        $('#menu a.logo').removeClass('active');
        $(currentLogo).addClass('active');
        $('.submenu').hide();
        var currentMenu = $('.submenu.'+currentLogo.className
            .replace('logo ','')
            .replace(' active',''));
        currentMenu.show();
    }
}


function menuRevert(activeSubmenu, activeLogo) {
    $('#menu a.logo').removeClass('active');
    activeLogo.addClass('active');
    $('.submenu').hide();
    activeSubmenu.show();
}


function setLanguage(lang) {
    // expiry in 14 days
    var expiry = new Date(Date.now() + 12096e5);
    document.cookie = "language="+lang+"; expires="+expiry.toUTCString()+";";
    // forced reload, bypassing caches
    window.location.reload(true);
}


/**
 *
 * @param nav           The single navigation element, containing all the navigation elements.
 * @param container     The many container elements, which are being toggled by the nav items.
 *                      Container elements have to be identified by an id attribute, which is
 *                      referred to in the data-toggle attribute in the nav items
 */
function sidebarNavigation(flex, nav, content) {
    $(nav).find('[data-toggle]').each(function(i) {
        $(this).click(function() {
            var target = $(this).attr('data-toggle');
            $(content).each(function() {
                $(this).hide();
            });
            $(nav).find('[data-toggle]').each(function(i) {
                $(this).removeClass('active');
            });
            $('#'+target).show();   // show content
            $(this).addClass('active');
        });
    });
    $(nav + ' .active').click();

    // check if the page navigation is inside a flex element:
    // hide the nav and make all content visible on small screens!
    hideWrappedNav(flex, nav, content);
    $(window).resize(function() {
        hideWrappedNav(flex, nav, content);
    });
}

function hideWrappedNav(flex, nav, content) {
    $(nav).show();
    $($(flex).children('.main-column')[0]).attr('style','');
    $(nav + ' .active').click();
    var wrappedItems = detectWrap(flex);
    if (wrappedItems.length > 0) {
        $(nav).hide();
        $($(flex).children('.main-column')[0]).attr('style','width:100%');
        $(content).each(function() {
            $(this).show();
        });
    }
}

function detectWrap(flex) {
    var wrappedItems = [];
    var prevItem = {};
    var currItem = {};
    var items = $(flex).children();
    for (var i = 0; i < items.length; i++) {
        currItem = items[i].getBoundingClientRect();
        if (prevItem && prevItem.top < currItem.top) {
            wrappedItems.push(items[i]);
        }
        prevItem = currItem;
    };
    return wrappedItems;
}
