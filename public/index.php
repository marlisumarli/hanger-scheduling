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
use Subjig\Report\Middleware\IsAdminMiddleware;
use Subjig\Report\Middleware\IsNotLoginMiddleware;
use Subjig\Report\Middleware\MandatoryLoginMiddleware;

Database::getConnection('prod');

// Admin dashboard
Router::get('GET', '/admin', AdminDashboardController::class, 'direct', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/dashboard', AdminDashboardController::class, 'index', [MandatoryLoginMiddleware::class]);

// login logout
Router::get('GET', '/admin/user/login', AdminUserController::class, 'login', [IsNotLoginMiddleware::class]);
Router::get('POST', '/admin/user/login', AdminUserController::class, 'postLogin', [IsNotLoginMiddleware::class]);
Router::get('GET', '/admin/user/logout', AdminUserController::class, 'logout', [MandatoryLoginMiddleware::class]);

// ScheduleSupply
Router::get('GET', '/admin/schedule', AdminScheduleSupplyController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/schedule/([0-9a-zA-Z|-]*)/create', AdminScheduleSupplyController::class, 'create', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/schedule/([0-9a-zA-Z|-]*)/create', AdminScheduleSupplyController::class, 'postCreate', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/schedule/([0-9a-zA-Z|-]*)/delete', AdminScheduleSupplyController::class, 'delete', [MandatoryLoginMiddleware::class]);

// user management
Router::get('GET', '/admin/user', AdminUserController::class, 'userManagement', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-create', AdminUserController::class, 'create', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user-create', AdminUserController::class, 'postCreate', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-update', AdminUserController::class, 'updateUserDetail', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user-update', AdminUserController::class, 'postUpdateUserDetail', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-update-password', AdminUserController::class, 'UpdatePassword', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user-update-password', AdminUserController::class, 'postUpdatePassword', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-delete', AdminUserController::class, 'delete', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);

// Item
Router::get('GET', '/admin/item', AdminItemController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/item', AdminItemController::class, 'postRegister', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/update', AdminItemController::class, 'postTmp', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/hanger/register', AdminItemController::class, 'postHangerRegister', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/hanger/update', AdminItemController::class, 'update', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/item/([0-9a-zA-Z|-]*)/hanger/update', AdminItemController::class, 'postUpdate', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/item/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', AdminItemController::class, 'delete', [MandatoryLoginMiddleware::class]);

// Supply
Router::get('GET', '/admin/supply', AdminSupplyController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)', AdminSupplyController::class, 'schedule', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)', AdminSupplyController::class, 'dataReport', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/create', AdminSupplyController::class, 'create', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/create', AdminSupplyController::class, 'postCreate', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/view', AdminSupplyController::class, 'view', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', AdminSupplyController::class, 'update', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', AdminSupplyController::class, 'postUpdate', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', AdminSupplyController::class, 'delete', [MandatoryLoginMiddleware::class]);

// laporan
Router::get('GET', '/admin/laporan', AdminDataReportController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/laporan/([0-9a-zA-Z|-]*)/supply', AdminDataReportController::class, 'supply', [MandatoryLoginMiddleware::class]);

// Guest
Router::get('GET', '/', HomeController::class, 'index', []);

Router::run();
