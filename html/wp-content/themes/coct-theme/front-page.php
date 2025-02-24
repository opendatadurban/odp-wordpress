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
  <a href="<?php echo home_url()."/economic-analysis"; ?>" class="item">
    <img src="<?php echo get_theme_file_uri('/images/economic_analysis_icon.png'); ?>">
    <br>
    <span>Economic Analysis</span>
  </a>
  <a href="<?php echo home_url()."/research"; ?>" class="item">
    <img src="<?php echo get_theme_file_uri('/images/research_icon.png'); ?>">
    <br>
    <span>Research</span>
    </a>
</div>



<div id="home-sub-footer" class="container">
  <div class="item">
      <a href="#">
          <img src="<?php echo get_theme_file_uri('/images/city-of-cape-town-grey-logo.png'); ?>">        
      </a>
    </div>
    <div class="item">
      <h2>Learn More</h2>
      <div class="sub-footer-block">
        <a href="https://resource.capetown.gov.za/documentcentre/Documents/Bylaws%20and%20policies/Open_Data_Policy.pdf" target="_blank" class="footer-link">
          Open Data Policy</a>
      </div>
      <div class="sub-footer-block">
        <a href="https://www.capetown.gov.za/General/Terms-of-use-open-data" target="_blank" class="footer-link">
        Open Data Terms of Use</a>
      </div>
    </div>
    <div class="item">
      <h2>Contact Us</h2>
      <div class="sub-footer-block">
      <a href="https://www.capetown.gov.za/_layouts/15/WebFeedback.SharePoint/webfeedback.aspx?id=b6e1c6d2-bbae-41d0-8763-5ca141cbe5c3" target="_blank" class="footer-link">Suggest a data set</a>
      </div>
      <div class="sub-footer-block">
      <a href="https://www.capetown.gov.za/_layouts/15/WebFeedback.SharePoint/webfeedback.aspx?id=a4d982c7-16af-4b77-875e-89478d0a29cf" target="_blank" class="footer-link">Feedback</a>
      </div>
    </div>
</div>


    

<?php get_footer(); 