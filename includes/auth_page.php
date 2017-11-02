<?php

require("vendor/autoload.php");
require("includes/phpauth/phpauth/Config.php");
require("includes/phpauth/phpauth/Auth.php");

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = 'us-cdbr-iron-east-05.cleardb.net';
$username = 'bffd13713c3b11';
$password = 'ccc14f3a';
$db = 'heroku_80a591f53062628';

$dbh = new PDO("mysql:dbname=$db;host=$server;", $username, $password);

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->isLogged()) {
header('HTTP/1.0 403 Forbidden');
echo "Please <a href='login.php'>Login</a>";

exit();
}