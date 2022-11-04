<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserDetailRequest;
use Subjig\Report\Model\UserFactory;
use Subjig\Report\Model\UserLoginRequest;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Repository\UserRoleRepository;
use Subjig\Report\Service\UserDetailService;
use Subjig\Report\Service\UserService;

class AdminUserController
{
    private UserService $userService;
    private UserDetailService $userDetailService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($userRepository);

        $userDetailRepository = new UserDetailRepository(Database::getConnection());
        $this->userDetailService = new UserDetailService($userDetailRepository);
    }

    public function userManagement()
    {
        View::render('Admin/User/user', [
            'title' => 'Data Pengguna'
        ]);
    }

    public function create(): void
    {
        $role = new UserRoleRepository(Database::getConnection());
        View::render('Admin/User/create', [
            'title' => 'User Create',
            'role' => $role->findAll()
        ]);
    }

    public function postCreate(): void
    {
        $request = new UserFactory();
        $role = new UserRoleRepository(Database::getConnection());
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        $reqUserDetil = new UserDetailRequest();
        $reqUserDetil->credential = $_POST['username'];
        $reqUserDetil->fullName = $_POST['name'];
        $reqUserDetil->role = $_POST['role'];

        try {
            $this->userService->createUser($request);
            $this->userDetailService->submit($reqUserDetil);
            View::redirect('/admin/user-create');
        } catch (ValidationException $exception) {
            View::render('Admin/User/create', [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage(),
                'role' => $role->findAll()
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
            View::redirect('/admin/dashboard');
        } catch (ValidationException $exception) {
            View::render('Admin/User/login', [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage()
            ]);
        }
    }

}