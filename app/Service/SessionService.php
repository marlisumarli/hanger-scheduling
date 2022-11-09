<?php

namespace Subjig\Report\Service;


use Subjig\Report\Entity\Session;
use Subjig\Report\Entity\User;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;

class SessionService
{
    public const COOKIE_NAME = 'LOGIN';
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }

    public function create(string $username): Session
    {
        $session = new Session();
        $session->session_id = uniqid();
        $session->username = $username;

        $this->sessionRepository->save($session);

        setcookie(self::COOKIE_NAME, $session->session_id, time() + (60 * 60 * 24 * 30), '/');
        return $session;
    }

    public function destroy(): void
    {
        $sessionId = $_COOKIE[ self::COOKIE_NAME ] ?? '';
        $this->sessionRepository->deleteById($sessionId);
        setcookie(self::COOKIE_NAME, '', 1, '/');
    }

    public function current(): ?User
    {
        $sessionId = $_COOKIE[ self::COOKIE_NAME ] ?? '';

        $session = $this->sessionRepository->findById($sessionId);

        if ($session == null) {
            return null;
        }

        return $this->userRepository->findByUsername($session->username);
    }
}