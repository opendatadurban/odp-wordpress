<?php
    /**
    * Template Name: Economic Analysis Page
    */
?>  

<?php get_header(); ?>

<div class="top-page-blue-bar">
    <div></div>
    <div>
      <span>Home / Cape Town's Economy</span>
    </div>
    <div>
        <span style="width:300px;">
        Welcome to the Economic Analysis' Dashboard. A summary of key economic statistics as insight on Cape Town's Economy.        
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

  <div>  
  Contact Us: <a style="color:white;" href="mailto:economic.research@capetown.gov.za?subject=Query" class="link-6">economic.research@capetown.gov.za</a>
  </div>

</div>



<style>
/*  #economic-analysis-tab-content-container {
      background-color: white;
      grid-column-gap: 0px;
      grid-row-gap: 0px;
      grid-template-rows: auto auto;
      grid-template-columns: .25fr 1.75fr;
      grid-auto-columns: 1fr;
      display: grid;
  }*/




</style>

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
          
        <div style="border:0px solid blue;color:#4c4c4c;">
          <h2>Overview<br>
          Statistics</h2>
        </div>
        <div style="border:0px solid blue;">
            <img style="width: 48px;" src="<?php echo get_theme_file_uri('/images/overview_stats_icon_1.png'); ?>">
            <span style="color: #f90;font-size: 35px;line-height: 130%;">
              R645 B
            </span>
            <br>
            <span style="color: #afaeba;text-align: center;text-transform: uppercase;font-size: 12px;">
              GROSS DOMESTIC PRODUCT (GDP), 2024 Q1
            </span>
        </div>
        <div style="border:0px solid blue;">
              <img style="width: 48px;" src="<?php echo get_theme_file_uri('/images/overview_stats_icon_2.png'); ?>">
              <span style="color: #f90;font-size: 35px;line-height: 130%;">
                -0,4%
              </span>
              <br>
              <span style="color: #afaeba;text-align: center;text-transform: uppercase;font-size: 12px;">
                GDP GROWTH RATE, 2024 Q1
              </span>
        </div>
        <div style="border:0px solid blue;">
              <img style="width: 48px;" src="<?php echo get_theme_file_uri('/images/overview_stats_icon_3.png'); ?>">
              <span style="color: #f90;font-size: 35px;line-height: 130%;">
                R145 985 
              </span>
              <br>
              <span style="color: #afaeba;text-align: center;text-transform: uppercase;font-size: 12px;">
                GDP per capita, 2024 Q1
              </span>
        </div>
        
    </div>
    <!-- end of tab stats -->


    <!-- start of tab container -->
    <div class="tab-content-container" style="border: 1px solid #ccc; height:600px;background-color:#ccc; display:grid;grid-template-columns: .75fr 3.25fr;">
  
      <!-- start of tab sidebar -->
      <div class="tab_content_sidebar" style="border: 0px solid red;background-color:white;">

        <ul>
          <li style="list-style:none;font-weight: 700;font-size:16px;border-bottom:4px solid #ccc;width:80%;">
              <h3>Cape Town's Economy</h3>
          </li>
          <li style="list-style:none;font-weight: 300;font-size:16px;border-top:2px solid #ccc;width:80%;margin-top:15px;">
              <h3>Key Economic Indicators</h3>
          </li>
          <li style="font-weight: 200;font-size:16px;border-bottom:0px solid #ccc;width:80%;margin-top:15px;">
              <span>Mapping sectors and jobs</span>
          </li>
        </ul>      

      </div>
      <!-- end of tab sidebar -->

      <!-- start of tab iframe container -->
      <div class="tab_content_iframe"  style="border: 0px solid grey;background-color:white;">
          
          <!-- start of tab iframe headings -->
          <div style="display:grid; grid-template-columns: 4fr 1fr 1fr 1fr; border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; align-items:center;height: 55px;">

              <div style="color:#4c4c4c;">
                <h2 style="padding-left:20px;">Cape Town's Economy
                </h2>              
              </div>

              <div>
                <span style="color:#afaeba">AUTHOR:</span>
                <span style="color:#4c4c4c;font-weight: 500;">Economic Analysis Team</span>
              </div>

              <div>
                <span style="color:#afaeba">LAST UPDATE:</span>
                <span style="color:#4c4c4c;font-weight: 500;">11/9/2024</span>
              </div>

              <div>
                <a href="#" style="color:#4c4c4c;cursor: pointer;text-decoration: underline;font-weight: 500;">Meta Info</a>
              </div>

          </div>
          <!-- end of iframe headings -->

          <!-- start of tab iframe -->
          <div>
      
            <iframe id="iframe1" src="https://cct-metabase-08dfc53db4f6.herokuapp.com/public/dashboard/29e202e2-bb0b-401e-b20a-61c3caf1ba63" width="100%" height="1500px" frameborder="0"></iframe>
              
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

  <div id="economic_analysis_datastories_tab_content" class="tab_content tab-content-inactive" style="border: 0px solid blue;height:700px;background-color:white;">
      <div style="display: grid;grid-template-columns: .75fr 3fr 3fr;
            padding-top: 55px;padding-bottom: 55px;
            margin: 0px;">
            <div>
            </div>
            <div>
              <img src="<?php echo get_theme_file_uri('/images/data_stories_placeholder.jpg'); ?>">
            </div>
            <div>
            </div>
        
      </div>
  </div>  
  
  <div id="economic_analysis_datasets_tab_content" class="tab_content tab-content-inactive" style="border: 0px solid blue;height:1500px;background-color:white;">
    <iframe src="https://odp-cctegis.opendata.arcgis.com/search?collection=dataset" width="100%" height="100%" frameborder="0"></iframe>
  </div>  
  

</div>
    

<?php //get_footer(); 