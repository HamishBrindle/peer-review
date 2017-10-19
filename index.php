<?php

session_start();

include('includes/head.html');

?>

         <div class="cover-container">

             <?php
             include_once('includes/navigation.html');
             ?>

             <div class="inner cover">
                 <h1 class="cover-heading">Make sure your code isn't shit!</h1>
                 <p class="lead">Post your code and have it reviewed by the finest minds in the BCIT CST program. We'll tell you what can stay, needs fixing, and needs to go!</p>
                 <p class="lead">
                     <a href="submit.php" class="btn btn-lg btn-secondary">Start Now</a>
                 </p>
             </div>


 <?php

include('includes/foot.html');

  ?>
