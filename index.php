<?php
/**
 * index.php
 */

get_header();

// generate flexslider markup
$fs = '<div class="flex-container">';
$fs .= '<div id="flexslider-1" class="flexslider">';
$fs .= '<ul class="slides">';
$fs .= '<li class="card welcome">';
$fs .= '<div class="table">';
$fs .= '<div class="table-cell">';
$fs .= 'Welcome to FlashCards, please select a group of cards to study from the menu up thar.';
$fs .= '</div>';
$fs .= '</div>';
$fs .= '</li>';
$fs .= '</ul>';
$fs .= '</div>';
$fs .= '</div>';

echo $fs;

get_footer();
