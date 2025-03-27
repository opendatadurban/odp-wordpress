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

<div class="data_story_body">

    <!-- sidebar left -->
    <div></div>

    <div>
        <div class="data_story_back_button">
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