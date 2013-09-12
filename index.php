<?php
/**
 * index.php
 */

get_header();

// generate flexslider markup
$fs = '<div class="flex-wrap">';
$fs .= '<div class="flex-container">';
$fs .= '<div id="flexslider-1" class="flexslider">';
// #todo - here's where the yoshi font gets hooked up..., there's a css class and you just dynamiccammaammly bolt it to the .slides
$fs .= '<ul class="slides">';
$fs .= '<li class="card welcome">';
$fs .= '<div class="table">';
$fs .= '<div class="table-cell">';
$fs .= '<-- Welcome to FlashCards, -->';
$fs .= '</div>';
$fs .= '</div>';
$fs .= '</li>';
$fs .= '<li class="card welcome">';
$fs .= '<div class="table">';
$fs .= '<div class="table-cell">';
$fs .= '<-- Please select a group of cards to study<br />from the menu up top. -->';
$fs .= '</div>';
$fs .= '</div>';
$fs .= '</li>';
$fs .= '<li class="card welcome">';
$fs .= '<div class="table">';
$fs .= '<div class="table-cell">';
$fs .= '<-- Swipe left and right on the screen<br />to slide between cards -->';
$fs .= '</div>';
$fs .= '</div>';
$fs .= '</li>';
$fs .= '<li class="card welcome">';
$fs .= '<div class="table">';
$fs .= '<div class="table-cell">';
$fs .= '<-- have a good one ;) -->';
$fs .= '</div>';
$fs .= '</div>';
$fs .= '</li>';
$fs .= '</ul>';
$fs .= '</div>';
$fs .= '</div>';
$fs .= '</div>';

echo $fs;

get_footer();