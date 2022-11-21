<?php

require_once __DIR__.'/../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__."/../");
$dotenv->load();

require_once __DIR__.'/../app/Infra/Routes/routes.php';
SimpleRouter::start();

