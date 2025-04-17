<?php
    /**
    * Template Name: Department Page
    */
?>  

<?php get_header(); ?>

<?php
// Get the department permalink.
$page_link = get_permalink();

// Then get the custom fields for the deparment
$department = pods( 'department', get_the_id() );
$department_contact_us_info = $department->field( 'contact_us_info' );

$department_statistics_main_title = $department->field( 'statistics_main_title' );

$department_statistic_1_icon = $department->field( 'statistic_1_icon' );

$department_statistic_1_title_amount = $department->field( 'statistic_1_title_amount' );
$department_statistic_1_info_popup = $department->field( 'statistic_1_info_popup' );

$department_statistic_1_sub_title = $department->field( 'statistic_1_sub_title' );

$department_statistic_2_icon = $department->field( 'statistic_2_icon' );
$department_statistic_2_title_amount = $department->field( 'statistic_2_title_amount' );
$department_statistic_2_info_popup = $department->field( 'statistic_2_info_popup' );
$department_statistic_2_sub_title = $department->field( 'statistic_2_sub_title' );

$department_statistic_3_icon = $department->field( 'statistic_3_icon' );
$department_statistic_3_title_amount = $department->field( 'statistic_3_title_amount' );
$department_statistic_3_info_popup = $department->field( 'statistic_3_info_popup' );
$department_statistic_3_sub_title = $department->field( 'statistic_3_sub_title' );


$department_datasets_iframe_url = $department->field( 'datasets_iframe_url' );
$department_datasets_iframe_height = $department->field( 'datasets_iframe_url' );

/* Default dashboard fields */
/* If a department content is selected these will be overwritten below */
$dashboard_title = $department->field( 'dashboard_title' );
$main_default_dashboard_title = $dashboard_title;

$dashboard_author = $department->field( 'dashboard_author' );
$dashboard_last_update = date_create( $department->field( 'post_modified' ) );
$dashboard_meta_info = $department->field( 'dashboard_meta_info' );
$dashboard_iframe_url = $department->field( 'dashboard_iframe_url' );
$dashboard_iframe_height = $department->field( 'dashboard_iframe_height' );

/* Get data for vertical side tabs / list items (department content)  */
/* Get department category, then get department content */
$dept_cat_term_obj_list = get_the_terms( get_the_id(), 'department_category' );
$dept_cat_terms_string = join(', ', wp_list_pluck($dept_cat_term_obj_list, 'slug'));
$dept_cat_terms_arr = explode(",", $dept_cat_terms_string );

//Now get the department content by department category to which the department page belongs
$department_content_query_args = array(
  'post_type'=> 'department_content',
  'post_status'     => 'publish',
  /*'department_category'    => $dept_cat_terms_string,*/  
  'meta_key' => 'tab_order_number',
  'orderby' => array( 'meta_value_num' => 'ASC' ),
  'tax_query' => array(
        array(
        'taxonomy' => 'department_category',
        'field' => 'slug',
        'operator' => 'IN',
        'terms' => $dept_cat_terms_arr,
        ),
  ),

  'order'    => 'ASC',
  'posts_per_page'   => -1,
);
$department_content_query = new WP_Query( $department_content_query_args );
$department_content_posts = $department_content_query->posts;


//Get posted department content from the URL if there is
if (isset($_GET['dc'])) {
  $posted_dc_slug = $_GET['dc'];
} else {
  $posted_dc_slug = false;
}

//Then get the department content article data (for vertical tabs / list)
if ( $posted_dc = get_page_by_path( $posted_dc_slug, OBJECT, 'department_content' ) ) {
    
    $posted_dc_id = $posted_dc->ID;
    $posted_dc_title = $posted_dc->post_title;    

    //get pod
    $posted_dc_pod = pods( 'department_content', $posted_dc->ID );

    /* Because a department content article was selected these will be overwritten now */
    $dashboard_title = $posted_dc->post_title;    
    $dashboard_author = $posted_dc_pod->field( 'tab_author' );
    $dashboard_last_update = date_create( $posted_dc_pod->field( 'post_modified' ) );
    $dashboard_meta_info = $posted_dc_pod->field( 'tab_meta_info' );
    $dashboard_iframe_url = $posted_dc_pod->field( 'tab_iframe_url' );
    $dashboard_iframe_height = $posted_dc_pod->field( 'tab_iframe_height' );
    
}else {
  //$dp_id = 0;
}



/* Content for data stories tab */
$data_stories_query_args = array(
  'post_type'=> 'department_data_stor',
  /*'department_category'    => $dept_cat_terms_string,*/
  'orderby' => 'publish_date',
  'post_status'     => 'publish',
  'tax_query' => array(
        array(
        'taxonomy' => 'department_category',
        'field' => 'slug',
        'operator' => 'IN',
        'terms' => $dept_cat_terms_arr,
        ),
  ),

  'order'    => 'ASC',
  'posts_per_page'   => -1,
);
$data_stories_query = new WP_Query( $data_stories_query_args );
$data_stories_query_posts = $data_stories_query->posts;

?>


<div class="top_page_blue_bar">
    <div></div>
    <div class="top_blue_bar_breadcrumbs">   
      <a href="<?php echo home_url(); ?>"><span>Home</span></a>
      <span>/<span>
      <a href="<?php echo $page_link; ?>"><span><?php echo get_the_title(); ?></span></a>
      <?php
        // if a department content was clicked, add to breadcrumb
        if ( $posted_dc_slug ) {
          ?>
          <span>/<span>
          <a href="<?php echo $page_link."?dc=".$posted_dc_slug; ?>"><span><?php echo $posted_dc_title; ?></span></a>
          <?php
        }

      ?>
    </div>
    <div class="top_blue_bar_department_content">   
        <span>
            <?php echo get_the_content(); ?>
        </span>
    </div>
</div>

<!-- Output main page tabs -->

<div class="top_page_blue_bar_with_tab_buttons">
  <div></div>
    
  <div class="tab_button_container">
      <div id="single_department_dashboards_tab" class="tab_button">
          <a href="#">Dashboards</a>
      </div>
      <div id="single_department_datastories_tab" class="tab_button tab_inactive">
          <a href="#">Data Stories</a>
      </div>
      <div id="single_department_datasets_tab" class="tab_button tab_inactive">
          <a href="#">Datasets</a>
      </div>
  </div>  

  <div class="top_blue_bar_contact_us">  
    <span>
      <?php echo $department_contact_us_info; ?>
    </span>
  </div>

</div>

<!-- End of Output main page tabs -->

<!-- start of main analysys tab -->
<div id="single_department_dashboards_tab_content" class="tab_content">

    <!-- start of tab stats -->
    <div class="tab_stats_section">
        <!-- start of overview statistics  -->  
        <div class="tab_stats_main_title">
            <h2>
              <?php echo $department_statistics_main_title; ?>
            </h2>
        </div>
        <div class="tab_stats_info_block">
            <img class="statistic_img_big" src="<?php echo $department_statistic_1_icon["guid"]; ?>">
            <span class="big_title">
                <?php echo $department_statistic_1_title_amount; ?>
                <img id="dept_stat1_info_popup" class="statistic_img" src="<?php echo get_theme_file_uri('/images/statistics_info_icon.png'); ?>">
            </span>            
            <br>
            <span class="sub_title">
                <?php echo $department_statistic_1_sub_title; ?>
            </span>
            <div id="dept_stat1_info_popup_content" class="statistics_info_popup_content">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 24 24">
                  <path fill="CurrentColor" d="M14.5,12l9-9c0.7-0.7,0.7-1.8,0-2.5c-0.7-0.7-1.8-0.7-2.5,0l-9,9l-9-9c-0.7-0.7-1.8-0.7-2.5,0 c-0.7,0.7-0.7,1.8,0,2.5l9,9l-9,9c-0.7,0.7-0.7,1.8,0,2.5c0.7,0.7,1.8,0.7,2.5,0l9-9l9,9c0.7,0.7,1.8,0.7,2.5,0 c0.7-0.7,0.7-1.8,0-2.5L14.5,12z"></path>
                </svg>
                <pre><?php echo htmlspecialchars_decode($department_statistic_1_info_popup); ?></pre>
            </div>
        </div>
        <div class="tab_stats_info_block">
              <img class="statistic_img_big" src="<?php echo $department_statistic_2_icon["guid"]; ?>">
              <span class="big_title">
                  <?php echo $department_statistic_2_title_amount; ?>
                  <img id="dept_stat2_info_popup" class="statistic_img" src="<?php echo get_theme_file_uri('/images/statistics_info_icon.png'); ?>">
              </span>
              <br>
              <span class="sub_title">
                  <?php echo $department_statistic_2_sub_title; ?>
              </span>
              <div id="dept_stat2_info_popup_content" class="statistics_info_popup_content">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 24 24">
                  <path fill="CurrentColor" d="M14.5,12l9-9c0.7-0.7,0.7-1.8,0-2.5c-0.7-0.7-1.8-0.7-2.5,0l-9,9l-9-9c-0.7-0.7-1.8-0.7-2.5,0 c-0.7,0.7-0.7,1.8,0,2.5l9,9l-9,9c-0.7,0.7-0.7,1.8,0,2.5c0.7,0.7,1.8,0.7,2.5,0l9-9l9,9c0.7,0.7,1.8,0.7,2.5,0 c0.7-0.7,0.7-1.8,0-2.5L14.5,12z"></path>
                </svg>
                <pre><?php echo htmlspecialchars_decode($department_statistic_2_info_popup); ?></pre>
            </div>
        </div>
        <div class="tab_stats_info_block">
            <img class="statistic_img_big" src="<?php echo $department_statistic_3_icon["guid"]; ?>">
              <span class="big_title">
                  <?php echo $department_statistic_3_title_amount; ?>
                  <img id="dept_stat3_info_popup" class="statistic_img" src="<?php echo get_theme_file_uri('/images/statistics_info_icon.png'); ?>">
              </span>
              <br>
              <span class="sub_title">
                  <?php echo $department_statistic_3_sub_title; ?>
              </span>
              <div id="dept_stat3_info_popup_content" class="statistics_info_popup_content">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 24 24">
                  <path fill="CurrentColor" d="M14.5,12l9-9c0.7-0.7,0.7-1.8,0-2.5c-0.7-0.7-1.8-0.7-2.5,0l-9,9l-9-9c-0.7-0.7-1.8-0.7-2.5,0 c-0.7,0.7-0.7,1.8,0,2.5l9,9l-9,9c-0.7,0.7-0.7,1.8,0,2.5c0.7,0.7,1.8,0.7,2.5,0l9-9l9,9c0.7,0.7,1.8,0.7,2.5,0 c0.7-0.7,0.7-1.8,0-2.5L14.5,12z"></path>
                </svg>
                <pre><?php echo htmlspecialchars_decode($department_statistic_3_info_popup); ?></pre>
            </div>
        </div>
        <!-- end of overview statistics -->
        
    </div>
    <!-- end of tab stats -->

    <style>
/*
left_vertical_tab_current_tab_active
*/
    </style>

    <!-- start of tab container -->
    <div class="tab_content_container">
  
      <!-- start of tab sidebar -->
      <div class="tab_content_sidebar">
        <ul class="department_content_left_vertical_tabs">

            <!-- Vertical tabs for departement (department content) -->
            <?php
            // If no sub tab is selected, give main tab a bold and underline
            $current_vertical_tab_class = "";
            $bold_or_not = "";
            if ( !isset( $_GET['dc'] ) ) {
                $current_vertical_tab_class = "left_vertical_tab_current_tab_active";
                $bold_or_not = "font-weight: bold;";
            }
            ?>
            <!-- main default tab as set in department page -->
            <li class="department_content_left_vertical_tab_main <?php echo $current_vertical_tab_class; ?>">
                <a style="<?php echo $bold_or_not; ?>" href="<?php echo $page_link; ?>"><?php echo $main_default_dashboard_title; ?></a>
            </li>
            <?php
                //Loop through department content (vertical tabs) for this department page & Category)
                foreach($department_content_posts as $dcp) {                  
                  $dcp_pod = pods( 'department_content', $dcp->ID );
                  $dcp_is_main_tab = $dcp_pod->field( 'is_main_tab' );
                  $tab_iframe_url = $dcp_pod->field( 'tab_iframe_url' );
                  $current_vertical_tab_class = "";
                  $bold_or_not = "";

                  // Give the current tab a class with a underline & bold style
                  if ( isset( $_GET['dc'] ) && $dcp->post_name == $_GET['dc'] ) {
                      $current_vertical_tab_class = "left_vertical_tab_current_tab_active";
                      $bold_or_not = "font-weight: bold;";
                  }
                  /* Display vertical tabs */
                  if( @$dcp_is_main_tab[0] ){                    
                    ?>
                      <li class="department_content_left_vertical_tab_main <?php echo $current_vertical_tab_class; ?>">
                    <?php
                  }else{
                    ?>
                      <li class="department_content_left_vertical_tab_sub <?php echo $current_vertical_tab_class; ?>">
                    <?php
                  } 
                  //If the tab has a iframe, give it a link. 
                  //If not, do not give it a link
                  if( isset($tab_iframe_url) && !empty($tab_iframe_url) ){      
                      ?>       
                      <a style="<?php echo $bold_or_not; ?>" href="<?php echo $page_link."?dc=".$dcp->post_name; ?>">
                        <?php echo $dcp->post_title; ?>
                      </a>                    
                      <?php    
                  } else {
                    ?>       
                    <span>
                      <?php echo $dcp->post_title; ?>
                    </span>
                    <?php    
                  }
                  ?>
                  </li>
                  <?php
                                  
                }  
            ?>
        </ul>
      </div>
      <!-- end of tab sidebar -->

      
      <!-- First tab: Dashboards -->
      <!-- start of tab iframe container -->
      <div class="tab_content_main">

          <!-- start of tab title, author, last update headings -->
          <div class="tab_content_main_department_content">

              <div class="dashboard_title">
                <h2><?php echo $dashboard_title; ?></h2>              
              </div>
              
              <div class="dashboard_author_etc_container">
                  <div class="dashboard_author">
                    <span>AUTHOR:</span>
                    <span><?php echo $dashboard_author; ?></span>
                  </div>
                  <div class="dashboard_last_update">
                    <span><!--LAST UPDATE:--></span>
                    <span><?php //echo date_format($dashboard_last_update,"Y-m-d"); ?></span>
                  </div>
                  <div class="dashboard_meta_info_popup_button">
                    <a id="meta_info_popup_show" href="#">About this data</a>          
                  </div>
              </div>
              <div id="meta_info_popup_content">
                  <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 24 24">
                    <path fill="CurrentColor" d="M14.5,12l9-9c0.7-0.7,0.7-1.8,0-2.5c-0.7-0.7-1.8-0.7-2.5,0l-9,9l-9-9c-0.7-0.7-1.8-0.7-2.5,0 c-0.7,0.7-0.7,1.8,0,2.5l9,9l-9,9c-0.7,0.7-0.7,1.8,0,2.5c0.7,0.7,1.8,0.7,2.5,0l9-9l9,9c0.7,0.7,1.8,0.7,2.5,0 c0.7-0.7,0.7-1.8,0-2.5L14.5,12z"></path>
                  </svg>
                  <pre><?php echo htmlspecialchars_decode($dashboard_meta_info); ?></pre>
              </div>

          </div>
          <!-- end of tab title, author, last update headings  -->

          <!-- start of tab iframe -->
          <div>      
            <iframe id="dashboard_iframe" src="<?php echo $dashboard_iframe_url; ?>" width="100%" height="<?php echo $dashboard_iframe_height;?>px" frameborder="0">
            </iframe>              
          </div>

        </div>
        <!-- end of tab iframe container -->
      
    </div> 
    <!-- end of tab container --> 

  </div>
  <!-- start of main analysys tab -->
  
  <!-- other tabs -->

  <!-- Department page Data stories tabs -->
 

  <div id="single_department_datastories_tab_content" class="tab_content tab_content_inactive">
      <!-- Sidebar right -->
      <div></div>
      <div class="data_stories_container">          

              <?php
                foreach($data_stories_query_posts as $data_story){ 
                  $data_story_pod = pods( 'department_data_stor', $data_story->ID );
                  $data_story_author = $data_story_pod->field( 'data_story_author' );
                  $data_story_published_date = date_create( $data_story_pod->field( 'post_modified' ) );
                  $data_story_featured_image = $data_story_pod->field( 'data_story_featured_image' );
                  $data_story_preview_text = $data_story_pod->field( 'data_story_preview_text' );
                  $data_story_url = get_permalink( $data_story->ID );
                  
                  $data_story_categories = $data_story_pod->field('department_category.name');

                  ?>                 

                  <div class="data_story_item">

                    <a id="data_story_link_<?php echo $data_story->ID; ?>" class="data_story_link" href="<?php echo $data_story_url; ?>">   

                      <div class="data_story_image_text">
                          <?php echo $data_story_preview_text; ?>
                      </div>  
                                    
                      <div class="data_story_image_wrapper" style="background-image: url('<?php echo $data_story_featured_image["guid"]; ?>')">
                        <div class="data_story_chips_wrapper">
                            <span>
                            <?php echo implode(', ', $data_story_categories); ?>
                            </span>
                        </div>
                      </div>

                      <div class="data_story_white_text_box">
                        <div class="data_story_item_heading">
                          <?php echo $data_story->post_title; ?>
                        </div>
                        <div class="data_story_item_author">
                          <?php echo $data_story_author; ?>
                          <br>
                          <span>AUTHOR</span>
                        </div>
                        <div class="data_story_item_published">
                          <?php echo date_format($data_story_published_date,"Y-m-d"); ?>
                          <br>
                          <span>PUBLISHED</span>
                        </div>
                        <?php ; ?>
                      </div>  
                      
                    </a>
                  
                  </div>
                  

                <?php } ?>

              <!-- <img src="<?php //echo get_theme_file_uri('/images/data_stories_placeholder.jpg'); ?>"> -->
         
        
      </div>
      <!-- Sidebar right -->
      <div></div>
  </div>  
  
  <div id="single_department_datasets_tab_content" class="tab_content tab_content_inactive">
    <iframe src="<?php echo $department_datasets_iframe_url; ?>" width="100%" height="100%" frameborder="0"></iframe>
  </div>  
  

</div>
    

<?php get_footer(); 