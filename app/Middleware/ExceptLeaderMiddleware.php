<?php

namespace Subjig\Report\Middleware;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class ExceptLeaderMiddleware implements Middleware
{
    private UserRepository $userRepository;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $this->userRepository = new UserRepository($connection);

        $userSession = new SessionRepository($connection);

        $this->sessionService = new SessionService($userSession, $this->userRepository);
    }

    public function before(): void
    {
        if ($this->userRepository->findByUsername($this->sessionService->current()->getUsername())->getRoleId() == 2) {
            View::redirect('/admin');
        }
    }
}