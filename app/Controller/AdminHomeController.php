<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AdminHomeController
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
            'title' => 'Admin | Dashboard',
            'fullName' => Util::nameSplitter($userDetail->getFullName()),
            'roleId' => $userDetail->getRoleId(),
            'dashboard' => 'active'
        ];
        View::render('Admin/Home/index', compact('model'));
    }

    public function direct()
    {
        View::redirect('/admin/dashboard');
    }

}