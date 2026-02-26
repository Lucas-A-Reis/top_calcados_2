<?php
require_once __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('America/Sao_Paulo');
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();