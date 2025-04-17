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




/* Function that runs after user login and sets their permissions based on their department category access */
function set_user_department_category_access() {
    $user_meta = get_userdata( get_current_user_id() );

    $user_pod = pods( 'user', get_current_user_id() );
    $user_department_category_access = $user_pod->field( 'department_category_access' );

    $dept_cat_terms_string = join(', ', wp_list_pluck($user_department_category_access, 'term_id'));
    $dept_cat_terms_arr = explode(",", $dept_cat_terms_string );

    //Get all the department page ID's in these categories
    $department_page_args = array(
        'post_type'=> 'department',
        //'department_category' => $dept_cat_terms_string,            
        'tax_query' => array(
            array(
                'taxonomy' => 'department_category', //double check your taxonomy name in you dd 
                'field'    => 'id',
                'operator' => 'IN', 
                'terms'    => $dept_cat_terms_arr,
            ),
        ),        
        'posts_per_page'   => 10
    );
    $department_page_query = new WP_Query( $department_page_args );
    $department_page_query_posts = $department_page_query->posts;
    $dept_page_id_string = join(', ', wp_list_pluck($department_page_query_posts, 'ID'));
   // Now save the department page pots ID's
    $user_pod->save( 'allowed_department_page_ids', $dept_page_id_string );    
    

    //Get all the department content pots ID's in these categories
    $department_content_args = array(
        'post_type'=> 'department_content',
        //'department_category' => $dept_cat_terms_string,            
        'tax_query' => array(
            array(
                'taxonomy' => 'department_category', //double check your taxonomy name in you dd 
                'field'    => 'id',
                'operator' => 'IN', 
                'terms'    => $dept_cat_terms_arr,
            ),
        ),        
        'posts_per_page'   => 10
    );
    $department_content_query = new WP_Query( $department_content_args );
    $department_content_query_posts = $department_content_query->posts;
    $dept_content_id_string = join(', ', wp_list_pluck($department_content_query_posts, 'ID'));
    // Now save the department content pots ID's
    $user_pod->save( 'allowed_department_content_ids', $dept_content_id_string );    
    

    //Get all the department data stories pots ID's in these categories
    $department_data_story_args = array(
        'post_type'=> 'department_data_stor',
        //'department_category' => $dept_cat_terms_string,            
        'tax_query' => array(
            array(
                'taxonomy' => 'department_category', //double check your taxonomy name in you dd 
                'field'    => 'id',
                'operator' => 'IN', 
                'terms'    => $dept_cat_terms_arr,
            ),
        ),        
        'posts_per_page'   => 10
    );
    $department_data_story_query = new WP_Query( $department_data_story_args );
    $department_data_story_query_posts = $department_data_story_query->posts;
    $dept_data_story_id_string = join(', ', wp_list_pluck($department_data_story_query_posts, 'ID'));
    // Now save the department data story ID's
    $user_pod->save( 'allowed_department_data_story_ids', $dept_data_story_id_string );
}
//add_action('wp_login', 'set_user_department_category_access');
add_action( "in_admin_footer", "set_user_department_category_access" );


/* Filters user access based on previously set department category access */
if ( is_admin() ){
    global $pagenow;
    // If on an edit.php page
    if ($pagenow =='edit.php') {
        $user_meta = get_userdata( get_current_user_id() );
        // Only parse page results if its a department or editor user
        if ( in_array( "department_user", $user_meta->roles ) || in_array("editor", $user_meta->roles )  ){
            //Now run the parse filter
            add_filter( 'parse_query', 'filter_department_page_content_stories_ids' );
        }                
    }
}

//Filter department user or editor page ID's
function filter_department_page_content_stories_ids($query) {
    global $post_type;
    if ($post_type =='department') {
        $user_pod = pods( 'user', get_current_user_id() );
        //Get user's allowed department page ids
        $allowed_department_page_ids = $user_pod->field( 'allowed_department_page_ids' );
        $allowed_department_page_ids_arr = explode(",", $allowed_department_page_ids );
        //filter the id's
        $query->query_vars['post__in'] = $allowed_department_page_ids_arr;
    }  
    if ($post_type =='department_content') {
        $user_pod = pods( 'user', get_current_user_id() );
        //Get user's allowed department content page ids
        $allowed_department_content_ids = $user_pod->field( 'allowed_department_content_ids' );
        $allowed_ids_arr = explode(",", $allowed_department_content_ids );
        //filter the id's
        $query->query_vars['post__in'] = $allowed_ids_arr;
    }   
    if ($post_type =='department_data_stor') {
        $user_pod = pods( 'user', get_current_user_id() );
        //Get user's allowed department data story page ids
        $allowed_department_data_story_ids = $user_pod->field( 'allowed_department_data_story_ids' );
        $allowed_ids_arr = explode(",", $allowed_department_data_story_ids );
        //filter the id's
        $query->query_vars['post__in'] = $allowed_ids_arr;
    }        
}





