<?php

require("vendor/autoload.php");
require("includes/phpauth/phpauth/Config.php");
require("includes/phpauth/phpauth/Auth.php");

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$dbh = new PDO("mysql:host=$server; dbname=$db;", $username, $password);

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->isLogged()) {
header('HTTP/1.0 403 Forbidden');
echo "Please <a href='login.php'>Login</a>";

exit();
}