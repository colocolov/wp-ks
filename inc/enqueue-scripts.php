<?php

function ks_scripts() {
	
	//стили
	// bootstrap css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array(), null );
	// fontawesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array(), null );
	// animate css
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/plugins/animate-css/animate.css', array(), null );
	// icofont
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array(), null );
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/css/style.css', array('icofont'), null );
  // стили в корне темы
  wp_enqueue_style( 'ks-style', get_stylesheet_uri(), array('theme-style'), time() );


  // скрипты
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'google-map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'contact', get_template_directory_uri() . '/plugins/form/contact.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );


  // доп от underscores 
  wp_enqueue_script( 'ks-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ks_scripts' );
