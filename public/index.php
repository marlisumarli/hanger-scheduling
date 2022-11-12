<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Subjig\Report\App\Router;
use Subjig\Report\Config\Database;
use Subjig\Report\Controller\AdminHomeController;
use Subjig\Report\Controller\AdminUserController;
use Subjig\Report\Controller\CategoryController;
use Subjig\Report\Controller\HomeController;
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

// Category
Router::get('GET', '/admin/categories', CategoryController::class, 'index', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/categories', CategoryController::class, 'postCreate', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/categories-delete', CategoryController::class, 'delete', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/categories-update', CategoryController::class, 'update', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/categories-update-name-category', CategoryController::class, 'updateName', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/categories-update-name-category', CategoryController::class, 'postUpdateName', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('GET', '/admin/categories-update-id-category', CategoryController::class, 'updateId', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);
Router::get('POST', '/admin/categories-update-id-category', CategoryController::class, 'postUpdateId', [MandatoryLoginMiddleware::class, IsAdminMiddleware::class]);

// List Item
Router::get('GET', '/admin/list-item', ListItemController::class, 'index', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig', ListItemController::class, 'subjig', [MandatoryLoginMiddleware::class]);

// K2F
Router::get('GET', '/admin/list-item/subjig/k2f', ListItemController::class, 'k2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k2f', ListItemController::class, 'postK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k2f-update', ListItemController::class, 'updateK2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k2f-update', ListItemController::class, 'postUpdateK2f', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k2f-delete', ListItemController::class, 'deleteK2f', [MandatoryLoginMiddleware::class]);

// K1A
Router::get('GET', '/admin/list-item/subjig/k1a', ListItemController::class, 'k1a', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k1a', ListItemController::class, 'postK1A', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k1a-update', ListItemController::class, 'updateK1a', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/list-item/subjig/k1a-update', ListItemController::class, 'postUpdateK1a', [MandatoryLoginMiddleware::class]);
Router::get('GET', '/admin/list-item/subjig/k1a-delete', ListItemController::class, 'deleteK1a', [MandatoryLoginMiddleware::class]);

// Supply
Router::get('GET', '/admin/supply', SupplyController::class, 'index', [MandatoryLoginMiddleware::class]);

// K2F Supply
Router::get('GET', '/admin/supply/k2f', SupplyController::class, 'supplyK2f', [MandatoryLoginMiddleware::class]);
Router::get('POST', '/admin/supply/k2f', SupplyController::class, 'supplyK2f', [MandatoryLoginMiddleware::class]);

// Guest
Router::get('GET', '/', HomeController::class, 'index', []);

Router::run();
