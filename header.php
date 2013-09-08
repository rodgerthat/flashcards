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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/lib/img/favicon.ico" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <?php wp_head(); ?>
</head>
<body>
<header>

    <nav id="main-nav">
        <?php fc_generate_menu() ?>
    </nav>
</header>


