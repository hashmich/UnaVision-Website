
<ul id="submenu">
    <?php
    $submenu = array(
        'vision' => 'Vision',
        'mission' => 'Mission',
        'participate' => 'Mitmachen',
        'events' => 'Veranstaltungen',
        'newsletter' => 'Newsletter',
        'downloads' => 'Downloads'
    );

    foreach($submenu as $k => $v) {
        $active = null;
        if($k == $request OR ($request == '/' AND $k == 'vision'))
            $active = ' class="active"';

        echo '<li'.$active.'>';
        echo '<a href="'.Router::url($k).'">'.$v.'</a>';
        echo '</li>';
    }
    ?>
    <li class="language">
        [ <span class="lang-select" value="en">EN</span> | <span class="lang-select" value="de">DE</span> ]
    </li>
</ul>

