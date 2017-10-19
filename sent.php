<?php

session_start();

include('includes/head.html');

$email;

if (isset($_POST['code'])) {
  if (isset($_SESSION['email']) && isset($_SESSION['code'])) {
    $email = $_SESSION['email'];
    mail($email, "Peer Reviewing Your Code!", $_SESSION['code'] . PHP_EOL . "We'll be in touch soon.");
    echo '<h1>Success!</h1>';
  } else {
    echo '<h1>Failed...</h1>';
  }
} else {
  header("Location: submit.php");
}

?>



<?php
include('includes/foot.html');
 ?>
