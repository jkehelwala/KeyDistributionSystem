<?php
$active_url = $_SERVER['PHP_SELF'];
$menu_links = array(
    "/users/sysadmin/dashboard.php" => "Issuing Keys"
, "#1" => "View Machine Authorized Keys"
);  //Todo
?>

<ul class="nav nav-pills nav-stacked admin-menu">
    <?php foreach ($menu_links as $url => $title) {
        $class = "";
        if ($url == $active_url)
            $class = "active";
        ?>
        <li class="<?php echo $class; ?>"><a href="<?php echo $url; ?>"><?php echo $title; ?></a></li>
    <?php } ?>
</ul>