<?php
$request = $Request->getRequest();
switch($Request->getTheme()) {
    case 'unaversity':
        $menu = array(
            'unaversity' => 'UnaVersity',
            'unavillage' => 'UnaVillage',
            'vision' => 'UnaVision'
        );
        $submenu = array(
            'unaversity' => array(
                'de' => 'UnaVersity',
                'en' => 'UnaVersity'
            ),
            'events' => array(
                'de' => 'Veranstaltungen',
                'en' => 'Events'
            ),
            'cooperations' => array(
                'de' => 'Kooperationen',
                'en' => 'Cooperations'
            )
        );
        break;
    case 'unavillage':
        $menu = array(
            'unavillage' => 'UnaVillage',
            'unaversity' => 'UnaVersity',
            'vision' => 'UnaVision'
        );
        $submenu = array(
            'unavillage' => array(
                'de' => 'Gemeinschaft',
                'en' => 'Community'
            ),
            'locations' => array(
                'de' => 'Standorte',
                'en' => 'Locations'
            ),
            'vision-lab' => array(
                'de' => 'Visions-Labor',
                'en' => 'Vision-Lab'
            ),/*
            'prototype' => array(
                'de' => 'Prototyp',
                'en' => 'Prototype'
            ),
            /*
            array(
                'de' => 'Leute',
                'en' => 'People'
            )
            */
        );
        break;
    case 'unavision':
    default:
    $menu = array(
        'vision' => 'UnaVision',
        'unaversity' => 'UnaVersity',
        'unavillage' => 'UnaVillage'
    );
    $submenu = array(
        'vision' => array(
            'de' => 'Vision',
            'en' => 'Vision'
        ),
        'participate' => array(
            'de' => 'Mitmachen',
            'en' => 'Participate'
        ),
        'newsletter' => array(
            'de' => 'Newsletter',
            'en' => 'Newsletter'
        ),
        'contact' => array(
            'de' => 'Kontakt',
            'en' => 'Contact'
        ),
        'members' => array(
            'de' => 'Intern',
            'en' => 'Internal'
        )
    );
}

echo '<div id="menu">';
$i = 0;
foreach($menu as $k => $v) {
    $class = 'class="logo '.strtolower($v);
    if($i == 0) $class .= ' active';
    $class .= '"';
    $i++;

    if($k == 'vision') $k = '/';

    echo '<a '.$class.' href="'.Router::url($k).'">';
    echo $v;
    echo '</a>';
}
echo '</div>';
?>


<?php $lang = $Request->getUserLanguage(); ?>
<ul id="submenu">
    <?php
    foreach($submenu as $k => $v) {
        $active = null;
        if($k == $Request->getRequest() OR ($Request->getRequest() == '/' AND $k == 'vision'))
            $active = ' class="active"';

        echo '<li'.$active.'>';
        echo '<a href="'.Router::url($k).'">'.$v[$lang].'</a>';
        echo '</li>';
    }
    ?>
</ul>

