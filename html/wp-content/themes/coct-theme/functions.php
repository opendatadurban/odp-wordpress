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

/* Register menus */
register_nav_menus(
    array(
    'primary-menu' => __( 'Primary Menu' ),
    'secondary-menu' => __( 'Secondary Menu' )
    )
);

/* Add favicon to site header */
function coct_add_favicon(){ ?>
    <!-- Custom Favicons -->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico"/>
    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon.png">
    <?php 
}
add_action('wp_head','coct_add_favicon');


/* Function to redirect single department content posts to their department page  */
function redirect_department_content_posts() {
    if ( is_singular( 'department_content' ) ) {
        global $post;    
        $path = $post->post_name;
        $terms = get_the_terms( $post->ID , 'department_category' );
        //check if there is a categofry for the department content        
        if( isset($terms[0]->slug) && !empty($terms[0]->slug) ){

            /* Get correct department */
            $department_args = array(
                'post_type'=> 'department',
                'department_category' => $terms[0]->slug,
                'orderby' => 'publish_date',
                'post_status'     => 'publish',
                'tax_query' => array(
                    array(
                    'taxonomy' => 'department_category',
                    'field' => 'slug',
                    'terms' => $terms[0]->slug,
                    ),
                ),
            
                'order'    => 'ASC',
                'posts_per_page'   => -1,
            );
            $department_query = new WP_Query( $department_args );
            $department_query_posts = $department_query->posts;
            $department_slug = $department_query_posts[0]->post_name;

            $redirect_url = get_site_url() . '/department/' . $department_slug .'/?dc=' . $path;    
            wp_redirect( $redirect_url );
            exit;
        }else{
            $redirect_url = get_site_url();    
            wp_redirect( $redirect_url );
            exit;
        }            
    }
}
add_action( 'template_redirect', 'redirect_department_content_posts' );   





