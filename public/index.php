<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminDashboardController;
use Subjig\Report\Controller\AdminItemController;
use Subjig\Report\Controller\AdminScheduleController;
use Subjig\Report\Controller\AdminSupplyController;
use Subjig\Report\Controller\AdminUserController;
use Subjig\Report\Controller\DataController;
use Subjig\Report\Controller\HomeController;
use Subjig\Report\Middleware\AuthMiddleware;
use Subjig\Report\Middleware\ExceptLeaderMiddleware;
use Subjig\Report\Middleware\IsAdminMiddleware;
use Subjig\Report\Middleware\IsEmployeeMiddleware;
use Subjig\Report\Middleware\IsNotLoginMiddleware;

Database::getConnection('prod');

Router::get('GET', '/', HomeController::class, 'index', []);

// Admin dashboard
Router::get('GET', '/admin', AdminDashboardController::class, 'direct', [AuthMiddleware::class]);
Router::get('GET', '/admin/dashboard', AdminDashboardController::class, 'index', [AuthMiddleware::class]);

// login
Router::get('GET', '/admin/user/login', AdminUserController::class, 'login', [IsNotLoginMiddleware::class]);
Router::get('POST', '/admin/user/login', AdminUserController::class, 'postLogin', [IsNotLoginMiddleware::class]);

// logout
Router::get('GET', '/admin/user/logout', AdminUserController::class, 'logout', [AuthMiddleware::class]);

// Schedule
Router::get('GET', '/admin/schedule', AdminScheduleController::class, 'index', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/schedule/([0-9a-zA-Z|-]*)/create', AdminScheduleController::class, 'create', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/schedule/([0-9a-zA-Z|-]*)/create', AdminScheduleController::class, 'postCreate', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/schedule/([0-9a-zA-Z|-]*)/delete', AdminScheduleController::class, 'delete', [AuthMiddleware::class, IsAdminMiddleware::class]);

// Users
Router::get('GET', '/admin/users', AdminUserController::class, 'index', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/register', AdminUserController::class, 'postRegister', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/([0-9a-zA-Z|-]*)/update', AdminUserController::class, 'update', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user/([0-9a-zA-Z|-]*)/update', AdminUserController::class, 'postUpdate', [AuthMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user/([0-9a-zA-Z|-]*)/delete', AdminUserController::class, 'delete', [AuthMiddleware::class, IsAdminMiddleware::class]);

// Item List
Router::get('GET', '/admin/item', AdminItemController::class, 'index', [AuthMiddleware::class]);
Router::get('POST', '/admin/item', AdminItemController::class, 'postRegister', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/update', AdminItemController::class, 'update', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/update', AdminItemController::class, 'postUpdateType', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/hanger/update', AdminItemController::class, 'updateHanger', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/hanger/update', AdminItemController::class, 'postUpdateHanger', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', AdminItemController::class, 'delete', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);

// Supply
Router::get('GET', '/admin/supply', AdminSupplyController::class, 'index', [AuthMiddleware::class, IsEmployeeMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)', AdminSupplyController::class, 'scheduleMonitor', [AuthMiddleware::class, IsEmployeeMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/create', AdminSupplyController::class, 'create', [AuthMiddleware::class, IsEmployeeMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/create', AdminSupplyController::class, 'postCreate', [AuthMiddleware::class, IsEmployeeMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/view', AdminSupplyController::class, 'view', [AuthMiddleware::class, ExceptLeaderMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', AdminSupplyController::class, 'update', [AuthMiddleware::class, IsEmployeeMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', AdminSupplyController::class, 'postUpdate', [AuthMiddleware::class, IsEmployeeMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', AdminSupplyController::class, 'delete', [AuthMiddleware::class, IsEmployeeMiddleware::class]);

// Data supply
Router::get('GET', '/admin/supply-data/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)', DataController::class, 'supplyData', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply-data', DataController::class, 'index', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply-data/([0-9a-zA-Z|-]*)', DataController::class, 'scheduleData', [AuthMiddleware::class]);
Router::get('GET', '/admin/supply-data/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/export', DataController::class, 'export', [AuthMiddleware::class]);

Router::run();
