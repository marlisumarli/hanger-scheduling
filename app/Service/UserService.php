<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\User;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserDeleteRequest;
use Subjig\Report\Model\UserFactory;
use Subjig\Report\Model\UserLoginRequest;
use Subjig\Report\Model\UserResetPasswordRequest;
use Subjig\Report\Model\UserResponse;
use Subjig\Report\Model\UserUpdateRequest;
use Subjig\Report\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function requestCreateUser(UserFactory $request): UserResponse
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("Akun sudah ada, username : $request->username");
            }

            $user = new  User();
            $user->username = strtolower(trim($request->username));
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

//    TODO validation timeout login

    private function validateColumnCreateRequest(UserFactory $request): void
    {
        if ($request->username == null || $request->password == null ||
            trim($request->username) == '' || trim($request->password) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $request->username)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestLogin(UserLoginRequest $userLoginRequest): UserResponse
    {
        $user = $this->userRepository->findByUsername($userLoginRequest->username);

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

    public function requestDeleteUser(UserDeleteRequest $request): UserResponse
    {
        try {
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if ($user == null) {
                throw new ValidationException('Hapus gagal');
            } else {
                $user = new  User();
                $user->username = $request->username;
                $this->userRepository->deleteByUsername($user->username);
            }

            $response = new UserResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }


    public function requestUpdateUser(UserUpdateRequest $request): UserResponse
    {
        try {
            Database::beginTransaction();

            if ($request->repeatPassword != $request->password) {
                throw new ValidationException('Password tidak sama');
            }

            $user = new  User();
            $user->username = $request->username;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            $response = new UserResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}