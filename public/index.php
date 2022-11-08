<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminHomeController;
use Subjig\Report\Controller\AdminUserController;
use Subjig\Report\Controller\HomeController;
use Subjig\Report\Middleware\IsAdminMiddleware;
use Subjig\Report\Middleware\IsNotLoginMiddleware;
use Subjig\Report\Middleware\MandatoryLoginMiddleware;

Database::getConnection('prod');

// Admin dashboard
Router::get('GET', '/admin', AdminHomeController::class, 'direct', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/dashboard', AdminHomeController::class, 'index', [MandatoryLoginMiddleware::class]);

// login
Router::get('GET', '/admin/user/login', AdminUserController::class, 'login', [IsNotLoginMiddleware::class]);
Router::get('POST', '/admin/user/login', AdminUserController::class, 'postLogin', [IsNotLoginMiddleware::class]);
// logout
Router::get('GET', '/admin/user/logout', AdminUserController::class, 'logout', [MandatoryLoginMiddleware::class]);
// user management
Router::get('GET', '/admin/user', AdminUserController::class, 'userManagement', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/create', AdminUserController::class, 'create', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/create', AdminUserController::class, 'postCreate', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/update', AdminUserController::class, 'updateUserDetail', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/update', AdminUserController::class, 'postUpdateUserDetail', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/update/password', AdminUserController::class, 'UpdatePassword', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/update/password', AdminUserController::class, 'postUpdatePassword', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/delete', AdminUserController::class, 'delete', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);

// Guest
Router::get('GET', '/', HomeController::class, 'index', []);

Router::run();
