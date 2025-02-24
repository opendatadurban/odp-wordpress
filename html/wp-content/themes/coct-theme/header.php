<!DOCTYPE html>
<html <?php language_attributes();  ?>>
    
<head>
<meta charset="<?php bloginfo('charset'); ?>">    
<meta name="viewport" content="width=device-width, initial_scale=1">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="site-header">        
    <div style="width: 50%; border: 0px solid black;">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_theme_file_uri('/images/city-of-cape-town-logo.png'); ?>">        
        </a>
    </div>
    <div class="menu" style="width: 50%;">
        <a href="<?php echo home_url(); ?>">
        Home
        </a>     
    </div>
</header>   

        
