<?php

require_once '../vendor/autoload.php';

use Core\Hello;

$hello = new Hello();
var_dump($hello->foo());
