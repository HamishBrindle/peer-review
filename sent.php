<?php
require("vendor/autoload.php");

session_start();

if (!(isset($_POST['submit-type']) && isset($_POST['submit-header']) && isset($_POST['submit-editor']) && isset($_SESSION['userId'])))
    die("<a href='submit.php'> Try submitting again </a>");

$type = $_POST['submit-type'];
$header = $_POST['submit-header'];
$code = $_POST['submit-editor'];
$userId = $_SESSION['userId'];

$dotenv = new Dotenv\Dotenv(getcwd());
$dotenv->load();

$conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'),getenv('DB_PASSWORD')) or
die(mysqli_connect_error());

mysqli_select_db($conn, getenv('DB_DATABASE')) or
die(mysqli_error($conn));

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




