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

    public function postCreate(): void
    {
        $request = new UserFactory();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        $reqUserDetail = new UserDetailCreateRequest();
        $reqUserDetail->credential = $_POST['username'];
        $reqUserDetail->fullName = $_POST['name'];
        $reqUserDetail->role = $_POST['role'];

        try {
            $this->userService->requestCreateUser($request);
            $this->userDetailService->requestCreateUserDetail($reqUserDetail);
            View::render('Admin/User/create', [
                'success' => 'Berhasil dibuat'
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/User/create', [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage(),
                'role' => $this->userRoleRepository->findAll()
            ]);
        }
    }

    public function updateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        View::render('Admin/User/update', [
            'title' => 'User Update',
            'role' => $this->userRoleRepository->findAll(),
            'username' => $username,
            'name' => $result->fullName,
            'roleID' => $result->roleId
        ]);
    }

    public function postUpdateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        $requestUserDetail = new UserDetailUpdateRequest();
        $requestUserDetail->credential = $username;
        $requestUserDetail->fullName = $_POST['name'];
        $requestUserDetail->role = $_POST['role'];

        try {
            $this->userDetailService->requestUpdateUserDetail($requestUserDetail);
            View::render('Admin/User/update', [
                'success' => 'Berhasil diubah',
                'username' => $username,
                'name' => $result->fullName,
                'roleID' => $result->roleId
            ]);

        } catch (ValidationException $exception) {
            View::render('Admin/User/update', [
                'title' => 'Admin | Update',
                'error' => $exception->getMessage(),
                'username' => $username,
                'name' => $result->fullName,
                'roleID' => $result->roleId
            ]);
        }
    }

    public function updatePassword()
    {
        $username = $_GET['username'];

        View::render('Admin/User/update-password', [
            'title' => 'User Password',
            'username' => $username,
        ]);
    }

    public function postUpdatePassword()
    {
        $username = $_GET['username'];

        $request = new UserUpdateRequest();
        $request->username = $username;
        $request->password = $_POST['password'];
        $request->repeatPassword = $_POST['repeatPassword'];

        try {
            $this->userService->requestUpdateUser($request);
            View::render('Admin/User/update-password', [
                'title' => 'Update Password',
                'success' => 'Password berhasil diubah',
                'username' => $username,
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/User/update-password', [
                'title' => 'Update Password',
                'error' => $exception->getMessage(),
                'username' => $username,
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
            'title' => 'User Create',
            'role' => $this->userRoleRepository->findAll(),
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
            'title' => 'Data Pengguna',
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