<?php
/**
 * Created by PhpStorm.
 * User: sheldonlynn
 * Date: 2017-11-01
 * Time: 11:55 PM
 */

session_destroy();

setcookie("authID", "", time() - 600);
header("Location: /index.php");