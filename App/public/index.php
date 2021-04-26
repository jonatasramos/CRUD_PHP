<?php
use Dotenv\Dotenv;

require_once __DIR__.'/../vendor/autoload.php';

// load .env
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

require_once __DIR__.'/../application/Helpers/function_helper.php';
require_once __DIR__.'/../application/Routes/routes.php';
