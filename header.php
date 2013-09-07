<?php
/**
 * header.php
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <?php wp_head(); ?>
</head>
<body>
<header>

</header>
<nav>
    <ul>
        <li><button class="ajax-clicker" data-postid="37">click me dammit.</button></li>
        <li><button></button></li>
        <li><button></button></li>
        <li><button></button></li>
    </ul>
</nav>

