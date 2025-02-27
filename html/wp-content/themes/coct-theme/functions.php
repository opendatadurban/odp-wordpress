<?php 

function coct_theme_enqueue_styles() {
    wp_enqueue_style( 'main-styles', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'coct_theme_enqueue_styles' );


function coct_site_features(){

    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'coct_site_features');


//Enqueue theme js
function coct_scripts_with_jquery() {
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/coct.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'coct_scripts_with_jquery' );


// Add user back feedback code to head
function add_user_feedback_code() {
    ?>   
    <script>
            window.Userback = window.Userback || {};
            Userback.access_token = 'P-POCWZDNZOhBRSgc3GGI2YEj9s';
            // identify your logged-in users (optional)
            Userback.user_data = {
                id: "123456", // example data
                info: {
                name: "someone", // example data
                email: "someone@example.com" // example data
                }
            };
            (function(d) {
                var s = d.createElement('script');s.async = true;s.src = 'https://static.userback.io/widget/v1.js';(d.head || d.body).appendChild(s);
            })(document);
        </script>
    <?php
}
add_action('wp_head', 'add_user_feedback_code');






