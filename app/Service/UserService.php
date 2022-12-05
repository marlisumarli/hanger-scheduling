<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\UserRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\User;
use Subjig\Report\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function requestCreateUser(UserRequest $request): ResponseSubjigApp
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("Akun sudah ada, username : $request->username");
            }

            $user = new User();
            $user->setUsername(strtolower(trim($request->username)));
            $user->setPassword(password_hash($request->password, PASSWORD_BCRYPT));
            $user->setFullName(ucwords(trim($request->fullName)));
            $user->setRoleId($request->role);
            $this->userRepository->save($user);

            $response = new ResponseSubjigApp();
            $response->user = $user;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(UserRequest $request): void
    {
        if ($request->username == null || $request->password == null ||
            trim($request->username) == '' || trim($request->password) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $request->username)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestLogin(UserRequest $userLoginRequest): ResponseSubjigApp
    {
        $user = $this->userRepository->findByUsername($userLoginRequest->username);

        if ($user == null) {
            throw new ValidationException("Gagal login, username atau password salah");
        }
        if (password_verify($userLoginRequest->password, $user->getPassword())) {
            $response = new ResponseSubjigApp();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Gagal login, username atau password salah");
        }
    }

    public function requestUpdateUser(UserRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $user = new  User();
            $user->setUsername($request->username);
            $user->setFullName($request->fullName);
            $user->setRoleId($request->role);
            $user->setPassword(password_hash($request->password, PASSWORD_BCRYPT));
            $this->userRepository->update($user);

            $response = new ResponseSubjigApp();
            $response->user = $user;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestDeleteUser(UserRequest $request): ResponseSubjigApp
    {
        $user = $this->userRepository->findByUsername($request->username);
        $user = new  User();
        $user->setUsername($request->username);
        $this->userRepository->deleteByUsername($user->getUsername());
        $response = new ResponseSubjigApp();
        $response->user = $user;
        return $response;
    }
}