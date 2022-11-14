<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AdminHomeController
{
    private SessionService $sessionService;
    private UserDetailRepository $userDetailRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);

        $this->userDetailRepository = new UserDetailRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function index()
    {
        $username = $this->sessionService->current()->username;
        $userDetail = $this->userDetailRepository->findByUsername($username);

        $model = [
            'title' => 'Admin | Dashboard',
            'fullName' => $userDetail->getFullName(),
            'roleId' => $userDetail->getRoleId(),
        ];
        View::render('Admin/Home/index', compact('model'));
    }

    public function direct()
    {
        View::redirect('/admin/dashboard');
    }

}