<?php

require("vendor/autoload.php");
require("includes/phpauth/phpauth/Config.php");
require("includes/phpauth/phpauth/Auth.php");

$dotenv = new Dotenv\Dotenv(getcwd());
$dotenv->load();

// $dbh = new PDO("mysql:host=" . getenv('MYSQL_HOST') . ";dbname=" . getenv('DB_DATABASE') . ", " . getenv('DB_USERNAME') . ", " . getenv('DB_PASSWORD'));
$dbh = new PDO('mysql:host=' . getenv('MYSQL_HOST') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->isLogged()) {
header('HTTP/1.0 403 Forbidden');
echo "Please <a href='login.php'>Login</a>";

exit();
}
