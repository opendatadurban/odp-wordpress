<?php
    /**
    * Template Name: Department Story Page
    */
?>  

<?php get_header(); ?>

<?php
// Get the department permalink.
$page_link = get_permalink();

// Then get the custom fields for the deparment
$data_story_pod = pods( 'department_data_stor', get_the_id() );

$data_story_title = get_the_title();
$data_story_content = get_the_content();
//$data_story_title = $data_story_pod->field( 'post_title' );

?>

<style>

    .data_story_body {
        display:grid; 
        grid-template-columns: .75fr 5fr .75fr; 
        
        min-height:500px;
        background-color:white;

    }

    .data_storyback_button { 
        margin-top: 20px;
        margin-bottom: 30px;
      }

      .data_storyback_button a {
        color: #1e272e;
        background-color: #fff;
        border: 1px solid #1e272e;
        border-radius: 5px;        
        margin-left: 0;
        padding: 3px 20px;        
        font-size: 16px;
        font-weight: 400;
        box-shadow: 1px 1px 5px #00000040;
      }

      .data_story_header {
          background-color: #393d40;
          border-top-left-radius: 10px;
          border-top-right-radius: 10px;
          /*max-width: 1170px;*/

          justify-content: flex-start;
          align-items: center;
          margin-left: 0;
          margin-right: 0;
          padding-top: 50px;
          padding-left: 50px;
          padding-right: 50px;
          display: flex;
      }

      .data_story_header span {
          color: #fff;
          text-transform: uppercase;
          object-fit: fill;
          width: 100%;
          min-width: 100px;
          max-width: 100%;
          margin-bottom: 5px;
          padding-top: 0;        
          font-size: 30px;
          font-weight: 100;
          display: block;
          position: relative;
      }
      .data_story_header div {
          color: #fff;
          width: 100%;
          margin-top: 5px;
          margin-bottom: 15px;
          font-family: Avenirnextcyr, sans-serif;
          font-size: 18px;
          font-weight: 500;
          line-height: 24px;
      }
      .data_story_logo {
          justify-content: flex-end;
          align-items: center;
          display: flex;
          margin-bottom: 20px;
      } 

      .data_story_subheader {
          background-color: #393d40;          
          /*max-width: 1170px;*/
          margin-top: 2px;
          justify-content: flex-start;
          align-items: center;
          margin-left: 0;
          margin-right: 0;
          padding-top: 10px;
          padding-left: 50px;
          padding-right: 50px;
          padding-bottom: 10px;
          display: flex;
      }
      .data_story_author {
          width: 82%;
      }
      .data_story_author span {
          color: #fff;
          width: 100%;
          margin-bottom: 5px;
          font-family: Avenirnextcyr, sans-serif;
          font-size: 12px;
          font-weight: 300;
          line-height: 18px;
      }
      .data_story_author div {
          color: #fff;
          margin-bottom: 10px;
          font-family: Avenirnextcyr, sans-serif;
          font-size: 20px;
      }
      .data_story_published {
          width: 18%;
          text-align: right;
      }
      .data_story_published span {
          color: #fff;
          width: 100%;
          font-family: Montserrat, sans-serif;
          font-size: 12px;
          font-weight: 300;
          line-height: 18px;
      }
      .data_story_published div {
          color: #fff;
          margin-bottom: 10px;
          font-size: 20px;
      }
      .data_story_content {        
          border: 1px solid black;
          padding: 30px;
          border-bottom-left-radius: 20px;
          border-bottom-right-radius: 20px;
          margin-bottom: 50px;
      }

</style>

<div class="data_story_body">

    <!-- sidebar left -->
    <div></div>

    <div>
        <div class="data_storyback_button">
          <a href="#" onclick="window.history.go(-1); return false;">← Back</a>
        </div>


        <div class="data_story_header">
            <div class="data_story_title">
                <span>DATA STORY</span>
                <div><?php echo $data_story_title; ?> </div>
            </div>
            <div class="data_story_logo">
                <img src="<?php echo get_theme_file_uri('/images/city-of-cape-town-grey-logo.png'); ?>">        
            </div>
        </div>

        <div class="data_story_subheader">
            <div class="data_story_author">
                <span>AUTHOR</span>
                <div><?php echo "Research Team"; ?> </div>
            </div>
            <div class="data_story_published">
                <span>PUBLISHED</span>
                <div><?php echo "January 1, 2024"; ?> </div>
            </div>
        </div>

        <div class="data_story_content">
          
            <?php echo $data_story_content; ?>
        </div>


    </div>

    <!-- sidebar right -->
    <div></div>

  </div>


<?
    

get_footer();