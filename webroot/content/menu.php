<?php
$active = 'vision';
if(in_array($Request->getRequest(), array('unaversity'))) $active = 'versity';
if(in_array($Request->getRequest(), array('unavillage'))) $active = 'village';
?>

<div id="menu">
    <a class="logo vision<?php echo ($active == 'vision') ? ' active': '';?>"
       href="<?php echo Router::url('/'); ?>">UnaVision</a>
    <a class="logo versity<?php echo ($active == 'versity') ? ' active': '';?>"
       href="<?php echo Router::url('unaversity'); ?>">UnaVersity</a>
    <a class="logo village<?php echo ($active == 'village') ? ' active': '';?>"
       href="<?php echo Router::url('unavillage'); ?>">UnaVillage</a>
</div>

<?php include $Request->getUserLanguage().DS.'submenu.php'; ?>