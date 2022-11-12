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
            $user = [
                'title' => 'Admin | User Baru',
                'success' => 'Berhasil dibuat',
            ];
            View::render('Admin/User/create', compact('user'));

        } catch (ValidationException $exception) {
            $user = [
                'title' => 'Admin | User Baru',
                'error' => $exception->getMessage(),
                'allRole' => $this->userRoleRepository->findAll()
            ];
            View::render('Admin/User/create', compact('user'));
        }
    }

    public function updateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        $user = [
            'title' => 'Admin | User Update',
            'allRole' => $this->userRoleRepository->findAll(),
            'username' => $username ?? View::redirect('/'),
            'fullName' => $result->full_name ?? View::redirect('/'),
            'userRole' => $result->role_id
        ];
        View::render('Admin/User/update', compact('user'));
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
            $user = [
                'title' => 'Admin | User Update',
                'success' => 'Berhasil diubah',
                'username' => $username ?? '',
                'fullName' => $result->full_name ?? '',
                'userRole' => $result->role_id ?? ''
            ];
            View::render('Admin/User/update', compact('user'));

        } catch (ValidationException $exception) {
            $user = [
                'title' => 'Admin | User Update',
                'error' => $exception->getMessage(),
                'username' => $username ?? '',
                'fullName' => $result->full_name ?? '',
                'userRole' => $result->role_id ?? ''
            ];
            View::render('Admin/User/update', compact('user'));
        }
    }

    public function updatePassword()
    {
        $username = $_GET['username'] ?? View::redirect('/');
        $user = [
            'title' => 'Admin | User Password',
            'username' => $username ?? View::redirect('/'),
        ];
        View::render('Admin/User/update-password', compact('user'));
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
            $user = [
                'title' => 'Admin | User Password',
                'success' => 'Password berhasil diubah',
                'username' => $username,
            ];
            View::render('Admin/User/update-password', compact('user'));

        } catch (ValidationException $exception) {
            $user = [
                'title' => 'Admin | User Password',
                'error' => $exception->getMessage(),
                'username' => $username ?? View::redirect('/'),
            ];
            View::render('Admin/User/update-password', compact('user'));
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
            $user = [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage()
            ];
            View::render('Admin/User/login', compact('user'));
        }
    }

    public function create(): void
    {
        $user = [
            'title' => 'Admin | User Baru',
            'allRole' => $this->userRoleRepository->findAll(),
        ];
        View::render('Admin/User/create', compact('user'));
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect('/admin');
    }

    public function userManagement()
    {
        $user = [
            'title' => 'Admin | User',
            'admin' => $this->joinRepository->userData(1),
            'subjig' => $this->joinRepository->userData(2),
            'userRole' => $this->userRoleRepository->findAll(),
        ];
        View::render('Admin/User/user', compact('user'));
    }

    public function delete()
    {
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $request = new UserDeleteRequest();
            $request->username = $username;
            $this->userService->requestDeleteUser($request);

            $user = [
                'success' => '/admin/user'
            ];
            View::render('Admin/User/delete', compact('user'));
        }
    }
}