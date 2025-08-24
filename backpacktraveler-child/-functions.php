<?php

/*** Child Theme Function  ***/

function backpacktraveler_mikado_child_theme_enqueue_scripts() {
	
	$parent_style = 'backpacktraveler-mikado-default-style';
	
	wp_enqueue_style('backpacktraveler-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action( 'wp_enqueue_scripts', 'backpacktraveler_mikado_child_theme_enqueue_scripts' );