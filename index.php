<?php

require 'config.php';

function __autoload($class) {
    require "lib/$class.php";
}

$app = new Bootstrap();
$app->init();
