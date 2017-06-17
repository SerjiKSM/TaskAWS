<?php

define('ROOT', dirname(__FILE__));

require_once (ROOT.'/components/AutoLoad.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$rout = new Router();
$rout->run();