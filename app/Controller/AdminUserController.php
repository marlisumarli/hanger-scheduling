<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserDeleteRequest;
use Subjig\Report\Model\UserDetailCreateRequest;
use Subjig\Report\Model\UserDetailUpdateRequest;
use Subjig\Report\Model\UserFactory;
use Subjig\Report\Model\UserLoginRequest;
use Subjig\Report\Model\UserUpdateRequest;
use Subjig\Report\Repository\JoinRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Repository\UserRoleRepository;
use Subjig\Report\Service\SessionService;
use Subjig\Report\Service\UserDetailService;
use Subjig\Report\Service\UserService;

class AdminUserController
{
    private UserService $userService;
    private UserDetailService $userDetailService;
    private SessionService $sessionService;
    private UserRoleRepository $userRoleRepository;
    private JoinRepository $joinRepository;
    private UserRepository $userRepository;
    private UserDetailRepository $userDetailRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);

        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());
        $this->userDetailService = new UserDetailService($this->userDetailRepository);

        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $this->userRepository);

        $this->joinRepository = new JoinRepository(Database::getConnection());
        $this->userRoleRepository = new UserRoleRepository(Database::getConnection());
    }

    public function postCreate()
    {
        $request = new UserFactory();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        $reqUserDetail = new UserDetailCreateRequest();
        $reqUserDetail->username = $_POST['username'];
        $reqUserDetail->fullName = $_POST['name'];
        $reqUserDetail->roleId = $_POST['roleId'];

        try {
            $this->userService->requestCreateUser($request);
            $this->userDetailService->requestCreateUserDetail($reqUserDetail);
            View::render('Admin/User/create', [
                'title' => 'Admin | User Baru',
                'success' => 'Berhasil dibuat',
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/User/create', [
                'title' => 'Admin | User Baru',
                'error' => $exception->getMessage(),
                'roleId' => $this->userRoleRepository->findAll()
            ]);
        }
    }

    public function updateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        View::render('Admin/User/update', [
            'title' => 'Admin | User Update',
            'role' => $this->userRoleRepository->findAll(),
            'username' => $username ?? View::redirect('/'),
            'name' => $result->full_name ?? View::redirect('/'),
            'roleId' => $result->role_id
        ]);
    }

    public function postUpdateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        $requestUserDetail = new UserDetailUpdateRequest();
        $requestUserDetail->username = $username;
        $requestUserDetail->fullName = $_POST['name'];
        $requestUserDetail->roleId = $_POST['roleId'] ?? View::redirect('/');

        try {
            $this->userDetailService->requestUpdateUserDetail($requestUserDetail);
            View::render('Admin/User/update', [
                'title' => 'Admin | User Update',
                'success' => 'Berhasil diubah',
                'username' => $username ?? '',
                'name' => $result->full_name ?? '',
                'roleId' => $result->role_id ?? ''
            ]);

        } catch (ValidationException $exception) {
            View::render('Admin/User/update', [
                'title' => 'Admin | User Update',
                'error' => $exception->getMessage(),
                'username' => $username ?? '',
                'name' => $result->full_name ?? '',
                'roleId' => $result->role_id ?? ''
            ]);
        }
    }

    public function updatePassword()
    {
        $username = $_GET['username'] ?? View::redirect('/');

        View::render('Admin/User/update-password', [
            'title' => 'Admin | User Password',
            'username' => $username ?? View::redirect('/'),
        ]);
    }

    public function postUpdatePassword()
    {
        $username = $_GET['username'];

        $request = new UserUpdateRequest();
        $request->username = $username;
        $request->password = $_POST['password'] ?? View::redirect('/');
        $request->repeatPassword = $_POST['repeatPassword'];

        try {
            $this->userService->requestUpdateUser($request);
            View::render('Admin/User/update-password', [
                'title' => 'Admin | User Password',
                'success' => 'Password berhasil diubah',
                'username' => $username,
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/User/update-password', [
                'title' => 'Admin | User Password',
                'error' => $exception->getMessage(),
                'username' => $username ?? View::redirect('/'),
            ]);
        }
    }


    public function login()
    {
        View::render('Admin/User/login', [
            'title' => 'Admin | Masuk'
        ]);
    }

    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->requestLogin($request);
            $this->sessionService->create($response->user->username);

            View::redirect('/admin/dashboard');
        } catch (ValidationException $exception) {
            View::render('Admin/User/login', [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function create(): void
    {
        View::render('Admin/User/create', [
            'title' => 'Admin | User Baru',
            'roleId' => $this->userRoleRepository->findAll(),
        ]);
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect('/');
    }

    public function userManagement()
    {
        View::render('Admin/User/user', [
            'title' => 'Admin | User',
            'user' => [
                'userData1' => $this->joinRepository->userData(1),
                'userData2' => $this->joinRepository->userData(2),
                'userRole' => $this->userRoleRepository->findAll(),
            ],
        ]);
    }

    public function delete()
    {
        if (isset($_GET['username'])) {

            $username = $_GET['username'];
            $request = new UserDeleteRequest();
            $request->username = $username;
            $this->userService->requestDeleteUser($request);

            View::render('Admin/User/delete', [
                'success' => '/admin/user'
            ]);
        }
    }
}