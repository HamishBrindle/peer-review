<?php

require("vendor/autoload.php");
require("vendor/phpauth/phpauth/Config.php");
require("vendor/phpauth/phpauth/Auth.php");

$dbh = new PDO("mysql:host=localhost;dbname=roast", "root", "1234");

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);
$register = $auth->register('shel@sheldon.com', 'sheldon1234!', 'sheldon1234!');

$hash = $auth->login('shel@sheldon.com', 'sheldon1234!');

setcookie('authID', $hash['hash'], time() + 9000000000);

if (!$auth->isLogged()) {
header('HTTP/1.0 403 Forbidden');
echo "Forbidden";

exit();
}