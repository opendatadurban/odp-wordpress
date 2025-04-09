<!DOCTYPE html>
<html <?php language_attributes();  ?>>
    
<head>
<meta charset="<?php bloginfo('charset'); ?>">    
<meta name="viewport" content="width=device-width, initial_scale=1">

    <?php wp_head(); ?>
</head>

<?php 

$menu_name = 'primary-menu';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul id="menu-' . $menu_name . '">';

        foreach ( (array) $menu_items as $key => $menu_item ) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= '<li><a href="' . $url . '">' . $title . '</a></li>';
        }
        $menu_list .= '</ul>';
    } else {
        $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }

?>


<body <?php body_class(); ?>>
<header id="site_header">        
    <div></div>
    <div class="logo">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_theme_file_uri('/images/city-of-cape-town-logo.png'); ?>">        
        </a>
    </div>
    <div class="menu">        
        <?php
            echo $menu_list;
        ?>
    </div>
</header>   

        
