<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminDashboardController;
use Subjig\Report\Controller\AdminDataReportController;
use Subjig\Report\Controller\AdminItemController;
use Subjig\Report\Controller\AdminScheduleSupplyController;
use Subjig\Report\Controller\AdminSupplyController;
use Subjig\Report\Controller\AdminUserController;
use Subjig\Report\Controller\HomeController;
use Subjig\Report\Middleware\AuthMiddleware;
use Subjig\Report\Middleware\IsAdminMiddleware;
use Subjig\Report\Middleware\IsNotLoginMiddleware;

Database::getConnection('prod');

// Admin dashboard
Router::get('GET', '/admin', AdminDashboardController::class, 'direct', [AuthMiddleware::class]);
Router::get('GET', '/admin/dashboard', AdminDashboardController::class, 'index', [AuthMiddleware::class]);

// login logout
Router::get('GET', '/admin/user/login', AdminUserController::class, 'login', [IsNotLoginMiddleware::class]);
Router::get('POST', '/admin/user/login', AdminUserController::class, 'postLogin', [IsNotLoginMiddleware::class]);
Router::get('GET', '/admin/user/logout', AdminUserController::class, 'logout', [AuthMiddleware::class]);

// ScheduleSupply
Router::get('GET', '/admin/schedule', AdminScheduleSupplyController::class, 'index', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/schedule/([0-9a-zA-Z|-]*)/create', AdminScheduleSupplyController::class, 'create', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/schedule/([0-9a-zA-Z|-]*)/create', AdminScheduleSupplyController::class, 'postCreate', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/schedule/([0-9a-zA-Z|-]*)/delete', AdminScheduleSupplyController::class, 'delete', [AuthMiddleware::class, IsAdminMiddleware::class]);

// user management
Router::get('GET', '/admin/users', AdminUserController::class, 'index', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/register', AdminUserController::class, 'postRegister', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/([0-9a-zA-Z|-]*)/update', AdminUserController::class, 'update', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/([0-9a-zA-Z|-]*)/update', AdminUserController::class, 'postUpdate', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/([0-9a-zA-Z|-]*)/delete', AdminUserController::class, 'delete', [AuthMiddleware::class, IsAdminMiddleware::class]);

// Item
Router::get('GET', '/admin/item', AdminItemController::class, 'index', [AuthMiddleware::class]);
Router::get('POST', '/admin/item', AdminItemController::class, 'postRegister', [AuthMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/update', AdminItemController::class, 'postTmp', [AuthMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/hanger/register', AdminItemController::class, 'postHangerRegister', [AuthMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/hanger/update', AdminItemController::class, 'update', [AuthMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/hanger/update', AdminItemController::class, 'postUpdate', [AuthMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', AdminItemController::class, 'delete', [AuthMiddleware::class]);

// Supply
Router::get('GET', '/admin/supply', AdminSupplyController::class, 'index', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)', AdminSupplyController::class, 'schedule', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)', AdminSupplyController::class, 'dataReport', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/create', AdminSupplyController::class, 'create', [AuthMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/create', AdminSupplyController::class, 'postCreate', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/view', AdminSupplyController::class, 'view', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', AdminSupplyController::class, 'update', [AuthMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', AdminSupplyController::class, 'postUpdate', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', AdminSupplyController::class, 'delete', [AuthMiddleware::class]);

// Guest
Router::get('GET', '/', HomeController::class, 'index', []);

Router::run();
