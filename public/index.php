<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminHomeController;
use Subjig\Report\Controller\AdminUserController;
use Subjig\Report\Controller\HomeController;
use Subjig\Report\Controller\LaporanController;
use Subjig\Report\Controller\ListItemController;
use Subjig\Report\Controller\SupplyController;
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
Router::get('GET', '/admin/user-create', AdminUserController::class, 'create', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user-create', AdminUserController::class, 'postCreate', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-update', AdminUserController::class, 'updateUserDetail', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user-update', AdminUserController::class, 'postUpdateUserDetail', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-update-password', AdminUserController::class, 'UpdatePassword', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/user-update-password', AdminUserController::class, 'postUpdatePassword', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/user-delete', AdminUserController::class, 'delete', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);

// List Item
Router::get('GET', '/admin/list-item', ListItemController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig', ListItemController::class, 'subjig', [MandatoryLoginMiddleware::class]);

// K2F
Router::get('GET', '/admin/list-item/subjig/k2f', ListItemController::class, 'k2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k2f', ListItemController::class, 'postK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k2f-update', ListItemController::class, 'updateK2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k2f-update', ListItemController::class, 'postUpdateK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k2f-update-order', ListItemController::class, 'updateOrderedK2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k2f-update-order', ListItemController::class, 'postUpdateOrderedK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k2f-delete', ListItemController::class, 'deleteK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k2f-target', ListItemController::class, 'targetK2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k2f-target', ListItemController::class, 'postTargetK2f', [MandatoryLoginMiddleware::class]);


// Supply
Router::get('GET', '/admin/supply', SupplyController::class, 'index', [MandatoryLoginMiddleware::class]);
// Supply K2F
Router::get('GET', '/admin/supply/subjig/k2f', SupplyController::class, 'K2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/subjig/k2f', SupplyController::class, 'postCreateK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/subjig/k2f-update', SupplyController::class, 'updateK2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/subjig/k2f-update', SupplyController::class, 'postUpdateK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/subjig/delete', SupplyController::class, 'delete', [MandatoryLoginMiddleware::class]);

// laporan 2022
Router::get('GET', '/admin/laporan', LaporanController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/laporan/2022', LaporanController::class, 't2022', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/laporan/2022/subjig', LaporanController::class, 'subjig', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/laporan/2022/subjig/k2f', LaporanController::class, 'k2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/laporan/2022/subjig/k2f/supply', LaporanController::class, 'k2f', [MandatoryLoginMiddleware::class]);

// Guest
Router::get('GET', '/', HomeController::class, 'index', []);

Router::run();
