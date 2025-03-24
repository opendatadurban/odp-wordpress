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

/* Default dashboard fields */
/* If a department content is selected these will be overwritten below */
$dashboard_title = $department->field( 'dashboard_title' );
$main_default_dashboard_title = $dashboard_title;

$dashboard_author = $department->field( 'dashboard_author' );
$dashboard_last_update = $department->field( 'dashboard_last_update' );
$dashboard_meta_info = $department->field( 'dashboard_meta_info' );
$dashboard_iframe_url = $department->field( 'dashboard_iframe_url' );

/* Get data for vertical side tabs / list items (department content)  */
/* Get department category, then get department content */
$term_obj_list = get_the_terms( get_the_id(), 'department_category' );
$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

//Now get the department content by department category to which the department page belongs
$department_content_query_args = array(
  'post_type'=> 'department_content',
  'department_category'    => $terms_string,

  'tax_query' => array(
        array(
        'taxonomy' => 'department_category',
        'field' => 'slug',
        'terms' => $terms_string,
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
    $dashboard_last_update = $posted_dc_pod->field( 'tab_last_updated' );
    $dashboard_meta_info = $posted_dc_pod->field( 'tab_meta_info' );
    $dashboard_iframe_url = $posted_dc_pod->field( 'tab_iframe_url' );
    
}else {
  //$dp_id = 0;
}



/* Content for data stories tab */
$data_stories_query_args = array(
  'post_type'=> 'department_data_stor',
  'department_category'    => $terms_string,

  'tax_query' => array(
        array(
        'taxonomy' => 'department_category',
        'field' => 'slug',
        'terms' => $terms_string,
        ),
  ),

  'order'    => 'ASC',
  'posts_per_page'   => -1,
);
$data_stories_query = new WP_Query( $data_stories_query_args );
$data_stories_query_posts = $data_stories_query->posts;


?>

<style>

  /* top blue bar */
  .top_blue_bar_breadcrumbs span, .top_blue_bar_breadcrumbs a {
    color: #fff;
    text-decoration: none;
  }
  .top_blue_bar_breadcrumbs a:hover {    
    text-decoration: underline;
  }
  
  .top_blue_bar_contact_us span, .top_blue_bar_contact_us a {
    color: #fff;
    font-weight: 300;
  }

</style>

<div class="top-page-blue-bar">
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
    <div>
        <span style="width:300px;">
        <?php echo get_the_content(); ?>
        </span>
    </div>
</div>




<div class="top-page-blue-bar-with-tab-buttons">
  <div></div>
    
  <div class="tab-button-container">
      <div id="economic_analysis_dashboards_tab" class="tab_button">
          <a href="#">Dashboards</a>
      </div>
      <div id="economic_analysis_datastories_tab" class="tab_button tab-inactive">
          <a href="#">Data Stories</a>
      </div>
      <div id="economic_analysis_datasets_tab" class="tab_button tab-inactive">
          <a href="#">Datasets</a>
      </div>
  </div>  

  <div class="top_blue_bar_contact_us">  
    <span>
      <?php echo $department_contact_us_info; ?>
    </span>
  </div>

</div>


<!-- start of main analysys tab -->
<div id="economic_analysis_dashboards_tab_content" class="tab_content"  style="border: 0px solid blue;background-color:white;">

    <!-- start of tab stats -->
    <div class="tab_stats_section" style="border: 0px solid red;height:100px;background-color:white;padding:20px 15% 0px 15%;grid-column-gap: 16px;
    grid-row-gap: 16px;
    grid-template-rows: auto;
    grid-template-columns: .75fr 1fr 1fr 1fr;
    grid-auto-columns: 1fr;
    display: grid
;">
        <!-- start of overview statistics  -->  
        <div style="border:0px solid blue;color:#4c4c4c;">
            <h2>
              <?php echo $department_statistics_main_title; ?>
            </h2>
        </div>
        <div style="border:0px solid blue;">
            <img style="width: 48px;" src="<?php echo $department_statistic_1_icon["guid"]; ?>">
            <span style="color: #f90;font-size: 35px;line-height: 130%;">
                <?php echo $department_statistic_1_title_amount; ?>
            </span>
            <br>
            <span style="color: #afaeba;text-align: center;text-transform: uppercase;font-size: 12px;">
                <?php echo $department_statistic_1_sub_title; ?>
            </span>
        </div>
        <div style="border:0px solid blue;">
              <img style="width: 48px;" src="<?php echo $department_statistic_2_icon["guid"]; ?>">
              <span style="color: #f90;font-size: 35px;line-height: 130%;">
                  <?php echo $department_statistic_2_title_amount; ?>
              </span>
              <br>
              <span style="color: #afaeba;text-align: center;text-transform: uppercase;font-size: 12px;">
                  <?php echo $department_statistic_2_sub_title; ?>
              </span>
        </div>
        <div style="border:0px solid blue;">
              <img style="width: 48px;" src="<?php echo $department_statistic_3_icon["guid"]; ?>">
              <span style="color: #f90;font-size: 35px;line-height: 130%;">
                  <?php echo $department_statistic_3_title_amount; ?>
              </span>
              <br>
              <span style="color: #afaeba;text-align: center;text-transform: uppercase;font-size: 12px;">
                  <?php echo $department_statistic_3_sub_title; ?>
              </span>
        </div>
        <!-- end of overview statistics -->
        
    </div>
    <!-- end of tab stats -->

    <style>

        .tab-content-container {
          border: 1px solid #ccc; 
          height:600px;
          background-color:#ccc; 
          display:grid;
          grid-template-columns: .75fr 3.25fr;    
        }

        .tab_content_sidebar {
          border: 1px solid #ccc;
          background-color:white;
        }

        /* Start of vertical department content data tabs  */
        .department_content_left_vertical_tab_main {
          list-style:none;          
          /*border-bottom:4px solid #ccc;*/
          width:80%;    
          line-height: 130%;      
          padding: 15px 0px;;
        }
        .department_content_left_vertical_tab_main a {
          font-weight: 300;          
          font-size:18px;
          color: #b3b0b0;
          text-decoration: none;          
        }
        .department_content_left_vertical_tab_sub {
          font-weight: 200;
          font-size:16px;
          border-bottom:0px solid #ccc;
          width:80%;          
          padding: 15px;
        }
        .department_content_left_vertical_tab_sub a {
          font-weight: 300;          
          font-size:15px;
          color: #4c4c4c;
          text-decoration: none;
        }
        /* End of vertical department content data tabs  */

        /* Start of main content section for iframe */

        .tab_content_main {
          border: 0px solid grey;
          background-color: white;"
        }
        .tab_content_main_department_content {
          display:grid; 
          grid-template-columns: 4fr 1fr 1fr 1fr; 
          border-bottom: 1px solid #ccc; 
          border-left: 1px solid #ccc; 
          align-items:center;
          height: 55px;
        }

        /* End of main content section for iframe */

    </style>

    <!-- start of tab container -->
    <div class="tab-content-container">
  
      <!-- start of tab sidebar -->
      <div class="tab_content_sidebar">
        <ul class="department_content_left_vertical_tabs">


            <!-- main default tab as set in department page -->
            <li class="department_content_left_vertical_tab_main">
                <a href="#"><?php echo $main_default_dashboard_title; ?></a>
            </li>
            <?php
                //Loop through department content (vertical tabs) for this department page & Category)
                foreach($department_content_posts as $dcp) {                  
                  $dcp_pod = pods( 'department_content', $dcp->ID );
                  $dcp_is_main_tab = $dcp_pod->field( 'is_main_tab' );
                  
                  if( @$dcp_is_main_tab[0] ){                    
                    ?>
                      <li class="department_content_left_vertical_tab_main">
                    <?php
                  }else{
                    ?>
                      <li class="department_content_left_vertical_tab_sub">
                    <?php
                  }                  
                  ?>       
                    <a href="<?php echo $page_link."?dc=".$dcp->post_name; ?>"><?php echo $dcp->post_title; ?></a>
                  </li>
                  <?php                  
                }  
            ?>
        </ul>
      </div>
      <!-- end of tab sidebar -->

      <!-- start of tab iframe container -->
      <div class="tab_content_main">
          
          <!-- start of tab iframe headings -->
          <div class="tab_content_main_department_content">

              <div style="color:#4c4c4c;">
                <h2 style="padding-left:20px;"><?php echo $dashboard_title; ?></h2>              
              </div>

              <div>
                <span style="color:#afaeba">AUTHOR:</span>
                <span style="color:#4c4c4c;font-weight: 500;"><?php echo $dashboard_author; ?></span>
              </div>

              <div>
                <span style="color:#afaeba">LAST UPDATE:</span>
                <span style="color:#4c4c4c;font-weight: 500;"><?php echo $dashboard_last_update; ?></span>
              </div>

              <div>
                <a href="#" style="color:#4c4c4c;cursor: pointer;text-decoration: underline;font-weight: 500;">Meta Info</a>
                <!--
                <div>Popup content: <?php // echo $dashboard_meta_info; ?>
                -->
              </div>

          </div>
          <!-- end of iframe headings -->

          <!-- start of tab iframe -->
          <div>
      
            <iframe id="iframe1" src="<?php echo $dashboard_iframe_url; ?>" width="100%" height="1500px" frameborder="0"></iframe>
              
                <script>
                // Selecting the iframe element
                var iframe = document.getElementById("iframe1");
                
                // Adjusting the iframe height onload event
                iframe.onload = function(){
                    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
                }
              </script>

          </div>

        </div>
        <!-- end of tab iframe container -->
      
    </div> 
    <!-- end of tab container --> 

  </div>
  <!-- start of main analysys tab -->
  
  <!-- other tabs -->

  <style>

      /* Data stories tabs  */

      #economic_analysis_datastories_tab_content {
        display:grid; 
        grid-template-columns: .5fr 5fr .5fr; 
        border: 0px solid blue;
        /*height:700px;*/
        background-color:white;
        display: none;
      }
      .data_stories_container {
        display: flex;
        flex-wrap: wrap;  
        padding: 40px 50px;      
      }
      .data_story_item {
        position: relative;  
        flex: 25%;
        width: 350px; 
        height: 380px; 
        margin: 20px;
      }
      .data_story_link {
        /*height: 250px;
        width: 400px;        */
      }      
      .data_story_image_wrapper {  
        position: relative;      
        height: 250px;
        width: 400px;       
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;        
        -webkit-border-radius: 10px 10px 0px 0px;
        -moz-border-radius: 10px 10px 0px 0px;
        border-radius: 10px 10px 0px 0px;
        /*background-image: in for loop*/

        
      }      
      .data_story_chips_wrapper {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 4px;        
        background-color: #cc0;   
        border-radius: 4px;     
      }
      .data_story_chips_wrapper span {
        color: white;              
        text-decoration: none;      
      }
      .data_story_image_text {
        display: none;
        position: absolute;
        top: 12px;
        left: 12px;
        width: 350px;
        color: #4c4c4c;
        text-decoration: none;
        font-size: 12px;
        line-height: 25px;        
        object-fit: contain;
        font-size: 16px;              
        z-index: 99;        
      }

      .data_story_image_on_hover {
        background-color: #ffffffe6;
        opacity: 0.25;
        -webkit-text-fill-color: inherit;
      }
      
      .data_story_white_text_box {
        position: relative;
        background-color:white;
        /*border: 1px solid black;*/
        height: 129px;
        width: 400px;      
        box-shadow: 0 10px 10px #0000001a;
        border-radius: 5px;          
      }
      .data_story_item_heading {
        position: absolute;
        top: 25px;
        left: 30px;
        font-size: 18px;
        color: #0079c1;
      }
      .data_story_item_author {
        color: #4c4c4c;
        position: absolute;
        top: 70px;
        left: 30px;
      }
      .data_story_item_author span {
        color: #afaeba;
        font-weight: 500;
      }
      .data_story_item_published {
        color: #4c4c4c;
        position: absolute;
        top: 70px;
        left: 260px;
      }
      .data_story_item_published span {
        color: #afaeba;
        font-weight: 500;
      }

      /* Datasets main tab */
      #economic_analysis_datasets_tab_content {
        border: 0px solid blue;
        height: 1500px;
        background-color: white;
      }

  </style>

  <script>

jQuery(document).ready(function($) {        
    
        /* Economic Analysis Page Tabs */
        $('.data_story_link').hover(function(){
    
            var item_id = $(this).attr('id');            
            //console.log('#' + item_id + ' .data_story_image_text');
            $( '#' + item_id + ' .data_story_image_text' ).toggle();   
            $( '#' + item_id + ' .data_story_image_wrapper' ).toggleClass("data_story_image_on_hover");    
           
        });   
    
    })

  </script>

  <div id="economic_analysis_datastories_tab_content" class="tab_content tab-content-inactive" style="">
      <!-- Sidebar right -->
      <div></div>
      <div class="data_stories_container" style="">          

              <?php
                foreach($data_stories_query_posts as $data_story){ 
                  $data_story_pod = pods( 'department_data_stor', $data_story->ID );
                  $data_story_author = $data_story_pod->field( 'data_story_author' );
                  $data_story_published_date = $data_story_pod->field( 'data_story_published_date' );
                  $data_story_featured_image = $data_story_pod->field( 'data_story_featured_image' );
                  $data_story_url = get_permalink( $data_story->ID );

                  //var_dump($data_story_pod);

                  ?>                 

                  <div class="data_story_item">

                    <a id="data_story_link_<?php echo $data_story->ID; ?>" class="data_story_link" href="<?php echo $data_story_url; ?>">   

                      <div class="data_story_image_text">
                          The following sections serve as a guide to the Economy and Employment chapter, Population and Demographics chapter, the Environment and Natural Wealth chapter and the Urban Governance chapter.
                      </div>  
                                    
                      <div class="data_story_image_wrapper" style="background-image: url('<?php echo $data_story_featured_image["guid"]; ?>')">
                        <div class="data_story_chips_wrapper">
                            <span>
                              Research
                            </span>
                        </div>
                        <!--<div class="data_story_image_text">
                          The following sections serve as a guide to the Economy and Employment chapter, Population and Demographics chapter, the Environment and Natural Wealth chapter and the Urban Governance chapter.
                        </div>-->
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
                          <?php echo $data_story_published_date; ?>
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
  
  <div id="economic_analysis_datasets_tab_content" class="tab_content tab-content-inactive">
    <iframe src="<?php echo $department_datasets_iframe_url; ?>" width="100%" height="100%" frameborder="0"></iframe>
  </div>  
  

</div>
    

<?php //get_footer(); 