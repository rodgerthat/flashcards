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
    <!-- google chrome frame support -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- mobile meta -->
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- stylin -->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/lib/img/favicon.ico" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <!-- wp_head -->
    <?php wp_head(); ?>
</head>
<body>
<header>

    <nav id="main-nav">
        <?php fc_generate_menu() ?>
    </nav>
</header>


