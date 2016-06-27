<?php

require 'config.php';
require '../private/security.php'; // This file contains the credentials for the database, this should be secure in a different directory

function __autoload($class) {
    require "lib/$class.php";
}

$app = new Bootstrap();
$app->init();
