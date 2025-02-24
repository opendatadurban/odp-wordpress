<?php 

function coct_theme_enqueue_styles() {
    wp_enqueue_style( 'main-styles', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'coct_theme_enqueue_styles' );


function coct_site_features(){

    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'coct_site_features');


// Add something to the <head> section
function add_user_feedback_code() {
    ?>
   
    <script>
        window.Userback = window.Userback || {};
        Userback.access_token = 'A-ha8YH6mRJS2dB0Mh4GPd5I1qncr7GqYxyNMjBOSgrH05Z1b44';

        // identify your logged-in users (optional)
        Userback.user_data = {
            id: "123456", // example data
            info: {
                name: "someone", // example data
                email: "someone@example.com" // example data
            }
        };

        (function(d) {
            var s = d.createElement('script');
            s.async = true;
            s.src = 'https://static.userback.io/widget/v1.js';
            (d.head || d.body).appendChild(s);
        })(document);
        </script>

    <?php
}
add_action('wp_head', 'add_user_feedback_code');


/* Rescan for template pages */
function wp_42573_fix_template_caching( WP_Screen $current_screen ) {

	// Only flush the file cache with each request to post list table, edit post screen, or theme editor.
	if ( ! in_array( $current_screen->base, array( 'post', 'edit', 'theme-editor' ), true ) ) {
		return;
	}

	$theme = wp_get_theme();
	if ( ! $theme ) {
		return;
	}

	$cache_hash = md5( $theme->get_theme_root() . '/' . $theme->get_stylesheet() );
	$label = sanitize_key( 'files_' . $cache_hash . '-' . $theme->get( 'Version' ) );
	$transient_key = substr( $label, 0, 29 ) . md5( $label );
	delete_transient( $transient_key );
}
//add_action( 'current_screen', 'wp_42573_fix_template_caching' );



