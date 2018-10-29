
<ul id="submenu">
    <?php
    $submenu = array(
        'vision' => 'Vision',
        'participate' => 'Participate',
        'events' => 'Events',
        'newsletter' => 'Newsletter',
        'downloads' => 'Downloads'
    );

    foreach($submenu as $k => $v) {
        $active = null;
        if($k == $Request->getRequest() OR ($Request->getRequest() == '/' AND $k == 'vision'))
            $active = ' class="active"';

        echo '<li'.$active.'>';
        echo '<a href="'.Router::url($k).'">'.$v.'</a>';
        echo '</li>';
    }

    $lang = $Request->getUserLanguage();
    ?>
    <li class="language">
        [ <span class="lang-select<?php if($lang == 'en') echo ' active'; ?>" value="en">EN</span> |
        <span class="lang-select<?php if($lang == 'de') echo ' active'; ?>" value="de">DE</span> ]
    </li>
</ul>

