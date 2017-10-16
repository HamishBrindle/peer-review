<?php

session_start();

include('includes/head.html');

?>

<div class="cover-container">

<div class="masthead clearfix">
    <div class="inner">
        <h3 class="masthead-brand">Peer Review</h3>
        <nav class="nav nav-masthead">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="#">Features</a>
            <a class="nav-link" href="#">Contact</a>
        </nav>
    </div>
</div>
</div>

<div class="jumbotron dark">
  <h1 class="display-3">Choose Your Language</h1>
  <p class="lead">Below are a list of supported languages (for the moment). Click the language you need help in!</p>
  <hr class="m-y-md">
</div>

<div class="container">
 <div class="row">
   <div class="col-md-12">
     <a href="java.php"><img src="assets/img/java-icon.png" alt="" class="img-rounded language-icon"></a>
     <a href="#"><img src="assets/img/c.png" alt="" class="img-rounded language-icon"></a>
     <a href="#"><img src="assets/img/javascript.png" alt="" class="img-rounded language-icon"></a>
   </div>
 </div>
</div>


<?php

include('includes/foot.html');

?>
