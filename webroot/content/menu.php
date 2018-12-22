<?php
$menu = array(
    'vision' => 'UnaVision',
    'events' => 'UnaVersity',
    'locations' => 'UnaVillage'
);



function getSubmenu($theme) {
    switch(strtolower($theme)) {
        case 'unaversity':
            return array(
                'events' => array(
                    'de' => 'Veranstaltungen',
                    'en' => 'Events'
                ),
                'unaversity' => array(
                    'de' => 'UnaVersity',
                    'en' => 'UnaVersity'
                ),
                'vision-lab-2019' => array(
                    'de' => 'Visions-Labor',
                    'en' => 'Vision-Lab'
                )
            );
        case 'unavillage':
            return array(
                'locations' => array(
                    'de' => 'Standorte',
                    'en' => 'Locations'
                ),
                'unavillage' => array(
                    'de' => 'Gemeinschaft',
                    'en' => 'Community'
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
        case 'unavision':
        default:
            return array(
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
}
?>


<div id="menu">
    <div id="primary_menu">

        <?php
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
        ?>
    </div>

    <?php
    $lang = $Request->getUserLanguage();
    foreach($menu as $k => $v) {
        $submenu = getSubmenu($v);
        $class = 'submenu '.strtolower($v);
        $hidden = ' style="display:none"';
        if(strtolower($v) == $Request->getTheme()) {
            $class .= ' active';
            $hidden = null;
        }
        ?>
        <ul class="<?php echo $class; ?>"<?php echo $hidden; ?>>
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
        <?php
    }
    ?>
</div>
