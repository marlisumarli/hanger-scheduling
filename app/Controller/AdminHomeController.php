<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\JoinRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AdminHomeController
{
    private SessionService $sessionService;
    private JoinRepository $joinRepository;
    private UserDetailRepository $userDetailRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);

        $this->userDetailRepository = new UserDetailRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
        $this->joinRepository = new JoinRepository(Database::getConnection());
    }


    public function index(): void
    {
        $user = $this->sessionService->current()->username;
        $userDetail = $this->userDetailRepository->findByUsername($user);

        View::render('Admin/Home/index', [
            'title' => 'Dashboard',
            'user' => $userDetail->getFullName(),
            'role' => $userDetail->getRoleId(),
            'userData2' => $this->joinRepository->userData(2),
        ]);
    }

    public function direct()
    {
        View::redirect('/admin/dashboard');
    }
}