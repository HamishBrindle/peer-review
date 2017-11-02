<?php
require("vendor/autoload.php");
$type = $_POST['submit-type'];
$header = $_POST['submit-header'];
$code = $_POST['submit-editor'];

$dotenv = new Dotenv\Dotenv(getcwd());
$dotenv->load();

$conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'),getenv('DB_PASSWORD')) or
die(mysqli_connect_error());

mysqli_select_db($conn, getenv('DB_DATABASE')) or
die(mysqli_error($conn));

$result = mysqli_query($conn, "
    INSERT INTO snippets(id, userId, type, header, code, roasted, date) VALUES(NULL,"
    . $_SESSION[userId] . ","
    . $type . ","
    . $header . ","
    . $code . ","
    . "0, NULL"
) or die(mysqli_error($conn));

print_r($result);
