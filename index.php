<?php

session_start();

include('includes/head.html');

?>

 <?php
 include_once('includes/navigation.html');
 ?>

 <div class="inner cover"> <!-- Main div for Homepage -->
     <h1 class="cover-heading">Make sure your code isn't shit!</h1>
     <p class="lead">Post your code and have it ROASTED by the finest minds in the BCIT CST program. We'll tell you what can stay, needs fixing, and needs to go!</p>
     <p class="lead">
         <a href="submit.php" class="btn btn-lg btn-secondary" id="start-button">Start Now</a>
         <a href="https://www.facebook.com/Roastmycode-1072499499552269/">
             <img src="src/img/fb.png" class="social-icon" style="width: 55px; background-color: #FFF; border-radius: 10px;">
         </a>
     </p>
 </div> <!-- End of main div for Homepage -->


 <?php

include('includes/foot.html');

  ?>
