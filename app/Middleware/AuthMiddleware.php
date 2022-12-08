<?php

namespace Subjig\Report\Middleware;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AuthMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function before(): void
    {
        $userSession = $this->sessionService->current();
        if ($userSession == null) {
            View::redirect('/admin/user/login');
        }
    }
}