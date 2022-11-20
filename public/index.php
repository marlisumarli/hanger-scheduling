<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminHomeController;
use Subjig\Report\Controller\AdminUserController;
use Subjig\Report\Controller\HomeController;
use Subjig\Report\Controller\LaporanController;
use Subjig\Report\Controller\ListItemController;
use Subjig\Report\Controller\SubjigController;
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
Router::get('GET', '/admin/list-item/subjig', ListItemController::class, 'typeItem', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig', ListItemController::class, 'postCreateType', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig-update', ListItemController::class, 'postUpdateType', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig-update', ListItemController::class, 'postUpdateType', [MandatoryLoginMiddleware::class]);

// Subjig
Router::get('GET', '/admin/subjig/([0-9a-zA-Z|-]*)', SubjigController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/subjig/([0-9a-zA-Z|-]*)/list', SubjigController::class, 'list', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/subjig/([0-9a-zA-Z|-]*)/list', SubjigController::class, 'postList', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/subjig/([0-9a-zA-Z|-]*)/list', SubjigController::class, 'postList', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/subjig/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)-delete', SubjigController::class, 'delete', [MandatoryLoginMiddleware::class]);

// Supply
Router::get('GET', '/admin/supply', SupplyController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)', SupplyController::class, 'create', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)', SupplyController::class, 'postCreate', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', SupplyController::class, 'update', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/update', SupplyController::class, 'postUpdate', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/supply/([0-9a-zA-Z|-]*)/([0-9a-zA-Z|-]*)/delete', SupplyController::class, 'delete', [MandatoryLoginMiddleware::class]);

// laporan
Router::get('GET', '/admin/laporan', LaporanController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/laporan/([0-9a-zA-Z|-]*)/supply', LaporanController::class, 'supply', [MandatoryLoginMiddleware::class]);

// Guest
Router::get('GET', '/', HomeController::class, 'index', []);

Router::run();
