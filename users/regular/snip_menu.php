<?php
/**
 * Snip menu for Regular user
 */
?>
<?php
$active_url = $_SERVER['PHP_SELF'];
$menu_links = array(
    $user->getDashboardLink() => "Request Key"
, "/users/regular/key_issued1.php" => "Issued Keys"
);
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