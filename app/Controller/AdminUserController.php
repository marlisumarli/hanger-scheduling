<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserRequest;
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

        $this->userRoleRepository = new UserRoleRepository(Database::getConnection());
    }

    public function postCreate()
    {
        $request = new UserRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        $reqUserDetail = new UserRequest();
        $reqUserDetail->username = $_POST['username'];
        $reqUserDetail->fullName = $_POST['name'];
        $reqUserDetail->roleId = $_POST['roleId'];

        try {
            $this->userService->requestCreateUser($request);
            $this->userDetailService->requestCreateUserDetail($reqUserDetail);
            $model = [
                'title' => 'Admin | User Baru',
                'success' => 'Berhasil dibuat',
            ];
            View::render('Admin/User/create', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | User Baru',
                'error' => $exception->getMessage(),
                'allRole' => $this->userRoleRepository->findAll()
            ];
            View::render('Admin/User/create', compact('model'));
        }
    }

    public function updateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        $model = [
            'title' => 'Admin | User Update',
            'allRole' => $this->userRoleRepository->findAll(),
            'username' => $username ?? View::redirect('/'),
            'fullName' => $result->full_name ?? View::redirect('/'),
            'userRole' => $result->role_id
        ];
        View::render('Admin/User/update', compact('model'));
    }

    public function postUpdateUserDetail()
    {
        $username = $_GET['username'];
        $result = $this->userDetailRepository->findByUsername($username);

        $requestUserDetail = new UserRequest();
        $requestUserDetail->username = $username;
        $requestUserDetail->fullName = $_POST['name'];
        $requestUserDetail->roleId = $_POST['roleId'] ?? View::redirect('/');

        try {
            $this->userDetailService->requestUpdateUserDetail($requestUserDetail);
            $model = [
                'title' => 'Admin | User Update',
                'success' => 'Berhasil diubah',
                'username' => $username ?? '',
                'fullName' => $result->full_name ?? '',
                'userRole' => $result->role_id ?? ''
            ];
            View::render('Admin/User/update', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | User Update',
                'error' => $exception->getMessage(),
                'username' => $username ?? '',
                'fullName' => $result->full_name ?? '',
                'userRole' => $result->role_id ?? ''
            ];
            View::render('Admin/User/update', compact('model'));
        }
    }

    public function updatePassword()
    {
        $username = $_GET['username'] ?? View::redirect('/');
        $model = [
            'title' => 'Admin | User Password',
            'username' => $username ?? View::redirect('/'),
        ];
        View::render('Admin/User/update-password', compact('model'));
    }

    public function postUpdatePassword()
    {
        $username = $_GET['username'];

        $request = new UserRequest();
        $request->username = $username;
        $request->password = $_POST['password'] ?? View::redirect('/');
        $request->repeatPassword = $_POST['repeatPassword'];

        try {
            $this->userService->requestUpdateUser($request);
            $model = [
                'title' => 'Admin | User Password',
                'success' => 'Password berhasil diubah',
                'username' => $username,
            ];
            View::render('Admin/User/update-password', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | User Password',
                'error' => $exception->getMessage(),
                'username' => $username ?? View::redirect('/'),
            ];
            View::render('Admin/User/update-password', compact('model'));
        }
    }

    public function login()
    {
        $model = [
            'title' => 'Admin | Masuk'
        ];
        View::render('Admin/User/login', compact('model'));
    }

    public function postLogin()
    {
        $request = new UserRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->requestLogin($request);
            $this->sessionService->create($response->user->username);
            View::redirect('/admin/dashboard');

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage()
            ];
            View::render('Admin/User/login', compact('model'));
        }
    }

    public function create(): void
    {
        $model = [
            'title' => 'Admin | User Baru',
            'allRole' => $this->userRoleRepository->findAll(),
        ];
        View::render('Admin/User/create', compact('model'));
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect('/admin');
    }

    public function userManagement()
    {
        $model = [
            'title' => 'Admin | User',
            'admin' => $this->userRepository->userData(1),
            'subjig' => $this->userRepository->userData(2),
            'userRole' => $this->userRoleRepository->findAll(),
        ];
        View::render('Admin/User/user', compact('model'));
    }

    public function delete()
    {
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $request = new UserRequest();
            $request->username = $username;
            $this->userService->requestDeleteUser($request);

            $model = [
                'success' => '/admin/user'
            ];
            View::render('Admin/User/delete', compact('model'));
        }
    }
}