<?php
    /**
    * Template Name: Economic Analysis Page
    */
?>  

<?php get_header(); ?>

<div class="top-page-blue-bar">
  <div>
    <span>Home / Cape Town's Economy</span>
  </div>
  <div>
    <span>
    Welcome to the Economic Analysis' Dashboard. A summary of key economic statistics as insight on Cape Town's Economy.
    Contact Us: economic.research@capetown.gov.za.
  </span>
  </div>
</div>

<div id="economic-analysis-tab-header">
Overview
Statistics

R645 B
Information_icon
GROSS DOMESTIC PRODUCT (GDP), 2024 Q1

-0,4%
Information_icon
GDP GROWTH RATE, 2024 Q1

R145 985

<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openCity('London')">London</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Paris')">Paris</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo')">Tokyo</button>
</div>

<div id="London" class="city">
  <h2>London</h2>
  <p>London is the capital of England.</p>
</div>

<div id="Paris" class="city" style="display:none">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p>
</div>

<div id="Tokyo" class="city" style="display:none">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
</div>


</div>





<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
}
  </script>
    

<?php get_footer(); 