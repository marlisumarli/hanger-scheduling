<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminHomeController;
use Subjig\Report\Controller\AdminUserController;

Database::getConnection('prod');

Router::get('GET', '/admin/dashboard', AdminHomeController::class, 'index', []);
// login
Router::get('GET', '/admin/user/login', AdminUserController::class, 'login', []);
Router::get('POST', '/admin/user/login', AdminUserController::class, 'postLogin', []);
// user management
Router::get('GET', '/admin/user', AdminUserController::class, 'userManagement', []);
Router::get('GET', '/admin/user-create', AdminUserController::class, 'create', []);
Router::get('POST', '/admin/user-create', AdminUserController::class, 'postCreate', []);
Router::get('GET', '/admin/user', AdminUserController::class, 'userManagement', []);


Router::run();
