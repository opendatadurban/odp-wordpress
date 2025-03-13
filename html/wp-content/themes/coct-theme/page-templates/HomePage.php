<?php
    /**
    * Template Name: Home Page
    */
?>  

<?php get_header(); ?>

<div id="home-banner">
  <div>
    <form action="/search" class="">
        <input class="search-input-2 w-input" maxlength="256" name="query" placeholder="Search " type="search" id="search" required="">
        <!--<input type="submit" class="search-button-2 w-button" value="Search">-->
    </form>
  </div>
  <div>Find out all about the City of Cape Town</div>  
</div>

<div id="home-page-links">
  <a href="<?php echo home_url()."/department/economic-analysis"; ?>" class="item">
    <img src="<?php echo get_theme_file_uri('/images/economic_analysis_icon.png'); ?>">
    <br>
    <span>Economic Analysis</span>
  </a>
  <a href="<?php echo home_url()."/department/research"; ?>" class="item">
    <img src="<?php echo get_theme_file_uri('/images/research_icon.png'); ?>">
    <br>
    <span>Research</span>
    </a>
</div>

   

<?php get_footer(); 