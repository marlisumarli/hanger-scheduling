<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AdminDashboardController
{
    private UserDetailRepository $userDetailRepository;
    private SessionService $sessionService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());
    }

    public function index()
    {
        $username = $this->sessionService->current()->getUsername();
        $userDetail = $this->userDetailRepository->findByUsername($username);

        $model = [
            'Title' => 'Admin | Dashboard',
            'full_name' => Util::nameSplitter($userDetail->getFullName()),
            'Dashboard' => 'active bg-warning',
        ];
        View::render('Admin/Dashboard/index', compact('model'));
    }

    public function direct()
    {
        View::redirect('/admin/dashboard');
    }
}