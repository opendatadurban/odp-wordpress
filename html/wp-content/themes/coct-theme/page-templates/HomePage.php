<?php
    /**
    * Template Name: Home Page
    */
?>  

<?php 
get_header(); 

/* Get departments */
$department_query_args = array(
  'post_type'=> 'department',
  'order'    => 'ASC',
  'orderby' => 'post_title',
  'post_status'     => 'publish',
  'posts_per_page'   => -1,
);
$department_query = new WP_Query( $department_query_args );
$department_query_posts = $department_query->posts;

?>

<div id="home_banner">
    <div></div>
    <div id="home_search_box">
      <form action="/search" class="">
          <!--<input class="search-input-2 w-input" maxlength="256" name="query" placeholder="Search " type="search" id="search" required="">-->
          <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
          <!--<input type="submit" class="search-button-2 w-button" value="Search">-->
      </form>
    </div>
    <div id="home_banner_title">
      Find out all about the City of Cape Town
    </div>  
    <div></div>
</div>


<div id="home_page_links">
  <!--
  <div></div>
  <a href="<?php //echo home_url()."/department/economic-analysis"; ?>" class="item">
      <img src="<?php //echo get_theme_file_uri('/images/economic_analysis_icon.png'); ?>">
      <br>
      <span>Economic Analysis</span>
  </a>
  <a href="<?php //echo home_url()."/department/research"; ?>" class="item">
      <img src="<?php //echo get_theme_file_uri('/images/research_icon.png'); ?>">
      <br>
      <span>Research</span>
  </a>
  <div></div>
  <div></div>
  -->  
   <?php
   foreach($department_query_posts as $department){
      $department_pod = pods( 'department', $department->ID );
      $department_featured_image = $department_pod->field( 'featured_image' );
      $department_url = get_post_permalink($department->ID);
        ?>
        <!--<div class="home_page_department">-->
            <a href="<?php echo $department_url; ?>" class="item">
                <img src="<?php echo $department_featured_image["guid"]; ?>">
                <br>
                <span><?php echo $department->post_title; ?></span>
            </a>
        <!--</div>-->
        <?php
   }  
   ?>
</div>

   

<?php get_footer(); 