<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminHomeController;

Database::getConnection('prod');

Router::get('GET', '/admin/dashboard', AdminHomeController::class, 'index');

Router::run();
