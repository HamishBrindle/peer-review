<?php

require("vendor/autoload.php");
require("includes/phpauth/phpauth/Config.php");
require("includes/phpauth/phpauth/Auth.php");

$dbh = new PDO("mysql:host=localhost;dbname=roast", "root", "1234");

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);
$register = $auth->register('shel@sheldon.com', 'sheldon1234!', 'sheldon1234!');

$hash = $auth->login('sheld@sheldon.com', 'sheldon1234!');

if (isset($hash['hash'])) {
    setcookie('authID', $hash['hash'], time() + 9000000000);
} else {
    header('HTTP/1.0 403 Forbidden');
    echo($hash['error'][1]);
}

if (!$auth->isLogged()) {
header('HTTP/1.0 403 Forbidden');
echo "Please <a href='login.php'>Login</a>";

exit();
}