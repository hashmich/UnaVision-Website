<?php
$request = $Request->getRequest();
switch($Request->getTheme()) {
    case 'unaversity':
        $menu = array(
            'unaversity' => 'UnaVersity',
            'unavillage' => 'UnaVillage',
            'vision' => 'UnaVision'
        );
        break;
    case 'unavillage':
        $menu = array(
            'unavillage' => 'UnaVillage',
            'unaversity' => 'UnaVersity',
            'vision' => 'UnaVision'
        );
        break;
    case 'unavision':
    default:
    $menu = array(
        'vision' => 'UnaVision',
        'unaversity' => 'UnaVersity',
        'unavillage' => 'UnaVillage'
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


<?php
$lang = $Request->getUserLanguage();
switch($lang) {
    case 'de':
        $submenu = array(
            'vision' => 'Vision',
            'participate' => 'Mitmachen',
            'newsletter' => 'Newsletter',
            'contact' => 'Kontakt'
        );
        break;
    case 'en':
    default:
    $submenu = array(
        'vision' => 'Vision',
        'participate' => 'Participate',
        'newsletter' => 'Newsletter',
        'contact' => 'Contact'
    );
}
?>
<ul id="submenu">
    <?php
    foreach($submenu as $k => $v) {
        $active = null;
        if($k == $Request->getRequest() OR ($Request->getRequest() == '/' AND $k == 'vision'))
            $active = ' class="active"';

        echo '<li'.$active.'>';
        echo '<a href="'.Router::url($k).'">'.$v.'</a>';
        echo '</li>';
    }


    ?>
    <li class="language">
        [ <span class="lang-select<?php if($lang == 'en') echo ' active'; ?>" value="en">EN</span> |
        <span class="lang-select<?php if($lang == 'de') echo ' active'; ?>" value="de">DE</span> ]
    </li>
</ul>

