<?php
function MYslider(){?>

<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
<?php
 global $wpdb;
   $update_positions_and_posts ="SELECT * FROM slider_settings WHERE id = 1";
   $Post_Setting_data = $wpdb->get_results($update_positions_and_posts);
     //print_r($Post_Setting_data);
     foreach ($Post_Setting_data as $settingData) {
      # code...
     }


?>

<div class="slideshow-container">
<h2><?php echo $settingData->slider_title; ?></h2>
<p><?php echo $settingData->slider_description; ?></p>
<?php $slider_time = $settingData->slider_time; ?>

<?php
 global $wpdb;
   $slider_images ="SELECT * FROM slider_images ORDER BY slider_order ASC";
   $slider_data = $wpdb->get_results($slider_images);
     //print_r($slider_data);
     foreach ($slider_data as $sliderData) { 
      $img_path = plugins_url()."/custom-slider/uploads/$sliderData->slider_image";
?>
      <div class="mySlides fade">
        <img src="<?php echo $img_path;?>" style="width:100%;max-height: 300px;height: 100%; ">
      </div>
      <div style="text-align:center;display: none;">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
      </div>
      
  <?php }?>

</div>
<br>



<script>
var slideIndex = 0;
var timer ="<?php echo esc_html($slider_time); ?>";//getting slider timer value from php database
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, timer); // timer of slider managed by here
}
</script>


<?php } 
add_shortcode('CustomSlider','MYslider');
?>