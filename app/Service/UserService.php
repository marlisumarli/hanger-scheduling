<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\User;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserFactory;
use Subjig\Report\Model\UserLoginRequest;
use Subjig\Report\Model\UserResponse;
use Subjig\Report\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserFactory $request): UserResponse
    {
        try {
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("Akun sudah ada, username : $request->username");
            }

            $user = new  User();
            $user->username = trim($request->username);
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $this->userRepository->save($user);

            $response = new UserResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestLogin(UserLoginRequest $userLoginRequest): UserResponse
    {
        $this->validateUserLoginRequest($userLoginRequest);

        $user = $this->userRepository->findByUsername(trim($userLoginRequest->username));
        if ($user == null) {
            throw new ValidationException("Gagal login, username atau password salah");
        }

        if (password_verify($userLoginRequest->password, $user->password)) {
            $response = new UserResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Gagal login, username atau password salah");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request): void
    {
        if ($request->username == null || $request->password == null ||
            trim($request->username) == '' || trim($request->password) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        }
    }
}