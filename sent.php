<?php
require("vendor/autoload.php");

session_start();

if (!(isset($_POST['submit-type']) && isset($_POST['submit-header']) && isset($_POST['submit-editor']) && isset($_SESSION['userId'])))
    die("<a href='submit.php'> Try submitting again </a>");

$server = 'us-cdbr-iron-east-05.cleardb.net';
$username = 'bffd13713c3b11';
$password = 'ccc14f3a';
$db = 'heroku_80a591f53062628';

$conn = mysqli_connect($server, $username, $password, $db) or
die(mysqli_connect_error());

$type = mysqli_real_escape_string($conn, $_POST['submit-type']);
$header = mysqli_real_escape_string($conn, $_POST['submit-header']);
$code = mysqli_real_escape_string($conn, $_POST['submit-editor']);
$userId = mysqli_real_escape_string($conn, $_SESSION['userId']);

$result = mysqli_query($conn, "
    INSERT INTO snippets VALUES(NULL,"
    . $userId . ","
    . '"' . $type . '"' . ","
    . '"' . $header . '"' . ","
    . '"' . $code . '"' . ","
    . "0, NULL)"
) or die(mysqli_error($conn));

include('includes/auth_page.php');
include('includes/head.html');
include_once('includes/navigation.html');
?>

<div class="container inner cover"> <!-- Main div -->

    <h1 class="cover-heading">Code Submitted!</h1>
    <a href="user.php"> Back to Profile </a>

</div> <!-- End of main div -->




