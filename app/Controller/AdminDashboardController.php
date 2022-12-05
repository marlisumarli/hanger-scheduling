<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AdminDashboardController
{
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function index()
    {
        $model = [
            'Title' => 'Admin | Dashboard',
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Dashboard' => 'active bg-warning',
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/Dashboard/index', compact('model'));
    }

    public function direct()
    {
        View::redirect('/admin/dashboard');
    }
}