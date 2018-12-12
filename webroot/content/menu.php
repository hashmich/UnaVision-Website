<?php
$menu = array(
    'vision' => 'UnaVision',
    'unaversity' => 'UnaVersity',
    'unavillage' => 'UnaVillage'
);

$request = $Request->getRequest();
switch($Request->getTheme()) {
    case 'unaversity':
         $submenu = array(
            'unaversity' => array(
                'de' => 'UnaVersity',
                'en' => 'UnaVersity'
            ),
            'events' => array(
                'de' => 'Veranstaltungen',
                'en' => 'Events'
            ),
            'vision-lab' => array(
                'de' => 'Visions-Labor',
                'en' => 'Vision-Lab'
            )
        );
        break;
    case 'unavillage':
        $submenu = array(
            'unavillage' => array(
                'de' => 'Gemeinschaft',
                'en' => 'Community'
            ),
            'locations' => array(
                'de' => 'Standorte',
                'en' => 'Locations'
            ),
            'cooperations' => array(
                'de' => 'Kooperationen',
                'en' => 'Cooperations'
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
    if($Request->getTheme() == strtolower($v)) $class .= ' active';
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

