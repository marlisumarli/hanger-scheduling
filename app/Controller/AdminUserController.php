<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\UserRequest;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Repository\UserRoleRepository;
use Subjig\Report\Service\SessionService;
use Subjig\Report\Service\UserService;

class AdminUserController
{
    private UserService $userService;
    private SessionService $sessionService;
    private UserRoleRepository $userRoleRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);

        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $this->userRepository);

        $this->userRoleRepository = new UserRoleRepository(Database::getConnection());
    }

    public function index()
    {
        View::render('Admin/User/index', [
            'Title' => 'Admin | User',
            'Users' => '',
            'user_role' => $this->userRoleRepository->findAll(),
            'users' => $this->userRepository,
            'session' => $this->sessionService->current(),
        ]);
    }

    public function postRegister()
    {
        $fullName = $_POST['fullName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $request = new UserRequest();
        $request->fullName = $fullName;
        $request->username = $username;
        $request->password = $password;
        $request->role = $role;

        try {
            $this->userService->requestCreateUser($request);
            View::render('Admin/User/tmp/tmp', [
                'success' => '/admin/users'
            ]);
        } finally {
            exit();
        }
    }

    public function update(string $username)
    {
        View::render('Admin/User/update', [
            'Title' => 'Admin | User',
            'Users' => '',
            'user' => $this->userRepository->findByUsername($username),
            'roles' => $this->userRoleRepository->findAll(),
            'session' => $this->sessionService->current(),
        ]);
    }

    public function postUpdate(string $username)
    {
        if (isset($_POST['name'])) {
            $request = new UserRequest();
            $request->username = $username;
            $request->fullName = $_POST['name'];
            $this->userService->requestUpdateUser($request);
            View::render('Admin/User/tmp/tmp', [
                'success' => "/admin/user/$username/update"
            ]);
        } elseif (isset($_POST['password'])) {
            $request = new UserRequest();
            $request->username = $username;
            $request->password = $_POST['password'];
            $this->userService->requestUpdateUser($request);
            View::render('Admin/User/tmp/tmp', [
                'success' => "/admin/user/$username/update"
            ]);
        } elseif (isset($_POST['role'])) {
            $request = new UserRequest();
            $request->username = $username;
            $request->role = $_POST['role'];
            $this->userService->requestUpdateUser($request);
            View::render('Admin/User/tmp/tmp', [
                'success' => "/admin/user/$username/update"
            ]);
        }

        View::render('Admin/User/update', [
            'Title' => 'Admin | User',
            'Users' => '',
            'user' => $this->userRepository->findByUsername($username),
            'roles' => $this->userRoleRepository->findAll(),
            'session' => $this->sessionService->current(),
        ]);
    }

    public function login()
    {
        View::render('Admin/User/login', [
            'title' => 'Admin | Masuk'
        ]);
    }

    public function postLogin()
    {
        $request = new UserRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->requestLogin($request);
            $this->sessionService->create($response->user->getUsername());
            View::redirect('/admin/dashboard');

        } catch (ValidationException $exception) {
            View::render('Admin/User/login', [
                'title' => 'Admin | Masuk',
                'error' => $exception->getMessage(),
                'session' => $this->sessionService->current(),
            ]);
        }
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect('/admin');
    }

    public function delete(string $username)
    {
        $request = new UserRequest();
        $request->username = $username;
        $this->userService->requestDeleteUser($request);

        View::render('Admin/User/delete', [
            'success' => '/admin/users'
        ]);
        exit();
    }
}