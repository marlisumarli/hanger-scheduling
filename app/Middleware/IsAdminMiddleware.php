<?php

namespace Subjig\Report\Middleware;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class IsAdminMiddleware implements Middleware
{
    private UserDetailRepository $userDetailRepository;
    private SessionService $sessionService;

    public function __construct()
    {
        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());

        $userRepository = new UserRepository(Database::getConnection());
        $userSession = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($userSession, $userRepository);
    }

    public function before(): void
    {
        $userSession = $this->sessionService->current()->username;
        $userDetail = $this->userDetailRepository->findByUsername($userSession);

        if ($userDetail->roleId != 1) {
            View::redirect('/admin');
        }
    }
}