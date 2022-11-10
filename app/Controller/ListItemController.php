<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\K2FCreateRequest;
use Subjig\Report\Model\K2FDeleteRequest;
use Subjig\Report\Model\K2FUpdateRequest;
use Subjig\Report\Repository\K2FRepository;
use Subjig\Report\Service\K2FService;

class ListItemController
{
    private K2FRepository $k2FRepository;
    private K2FService $k2FService;

    public function __construct()
    {
        $this->k2FRepository = new K2FRepository(Database::getConnection());
        $this->k2FService = new K2FService($this->k2FRepository);
    }

    public function index()
    {
        View::render('Admin/ListItem/index', [
            'title' => 'Admin | Daftar Subjig'
        ]);
    }

    public function subjig()
    {
        View::render('Admin/ListItem/Subjig/index', [
            'title' => 'Admin | Daftar Subjig'
        ]);
    }

//    TODO K2F
    public function k2f()
    {
        View::render('Admin/ListItem/Subjig/k2f', [
            'title' => 'Admin | Subjig K2F',
            'k2f' => $this->k2FRepository->findAll()
        ]);
    }

    public function postK2f()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $k2f = new K2FCreateRequest();
        $k2f->id = $this->k2FRepository::TYPE . $id;
        $k2f->name = $name;
        $k2f->qty = $qty;
        try {
            $this->k2FService->requestCreate($k2f);
            View::redirect('/admin/list-item/subjig/k2f');
        } catch (ValidationException $exception) {
            View::render('Admin/ListItem/Subjig/k2f', [
                'title' => 'Admin | K2F',
                'error' => $exception->getMessage(),
                'k2f' => $this->k2FRepository->findAll()
            ]);
        }
    }

    public function updateK2f()
    {
        $result = $this->k2FRepository->findById($_GET['id']);
        View::render('Admin/ListItem/Subjig/update', [
            'title' => 'Admin | Update Subjig K2F',
            'type' => $this->k2FRepository::TYPE,
            'id' => $_GET['id'],
            'name' => $result->k2f_name,
            'qty' => $result->k2f_qty,
        ]);
    }

    public function postUpdateK2f()
    {
        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $k2f = new K2FUpdateRequest();
        $k2f->id = $_GET['id'];
        $k2f->name = $name;
        $k2f->qty = $qty;
        try {
            $this->k2FService->requestUpdate($k2f);
            View::render('Admin/ListItem/Subjig/update', [
                'title' => 'Admin | Update K2F',
                'success' => "$k2f->id : Berhasil diubah",
                'type' => $this->k2FRepository::TYPE,
                'id' => $_GET['id'],
                'name' => $k2f->name,
                'qty' => $k2f->qty,
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/ListItem/Subjig/update', [
                'title' => 'Admin | Update K2F',
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function deleteK2f()
    {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $request = new K2FDeleteRequest();
            $request->id = $id;
            $this->k2FService->requestDelete($request);

            View::render('Admin/ListItem/Subjig/delete', [
                'success' => '/admin/list-item/subjig/k2f'
            ]);
        }
    }

//    TODO K1A
//    public function k1a()
//    {
//        View::render('Admin/ListItem/Subjig/k1a', [
//            'title' => 'Admin | Subjig K1A',
//            'k1a' => $this->k2FRepository->findAll()
//        ]);
//    }
//
//    public function postK1a()
//    {
//        $id = $_POST['id'];
//        $name = $_POST['name'];
//        $qty = $_POST['qty'];
//
//        $k2f = new K2FCreateRequest();
//        $k2f->id = $this->k2FRepository::TYPE . $id;
//        $k2f->name = $name;
//        $k2f->qty = $qty;
//        try {
//            $this->k2FService->requestCreate($k2f);
//            View::redirect('/admin/list-item/subjig/k1a');
//        } catch (ValidationException $exception) {
//            View::render('Admin/ListItem/Subjig/k1a', [
//                'title' => 'Admin | K2F',
//                'error' => $exception->getMessage(),
//                'k1a' => $this->k2FRepository->findAll()
//            ]);
//        }
//    }
//
//    public function updateK1a()
//    {
//        $result = $this->k2FRepository->findById($_GET['id']);
//        View::render('Admin/ListItem/Subjig/update', [
//            'title' => 'Admin | Update Subjig K2F',
//            'type' => $this->k2FRepository::TYPE,
//            'id' => $_GET['id'],
//            'name' => $result->k2f_name,
//            'qty' => $result->k2f_qty,
//        ]);
//    }
//
//    public function postUpdateK1a()
//    {
//        $name = $_POST['name'];
//        $qty = $_POST['qty'];
//
//        $k2f = new K2FUpdateRequest();
//        $k2f->id = $_GET['id'];
//        $k2f->name = $name;
//        $k2f->qty = $qty;
//        try {
//            $this->k2FService->requestUpdate($k2f);
//            View::render('Admin/ListItem/Subjig/update', [
//                'title' => 'Admin | Update K2F',
//                'success' => "$k2f->id : Berhasil diubah",
//                'type' => $this->k2FRepository::TYPE,
//                'id' => $_GET['id'],
//                'name' => $k2f->name,
//                'qty' => $k2f->qty,
//            ]);
//        } catch (ValidationException $exception) {
//            View::render('Admin/ListItem/Subjig/update', [
//                'title' => 'Admin | Update K2F',
//                'error' => $exception->getMessage(),
//            ]);
//        }
//    }
//
//    public function deleteK1a()
//    {
//        if (isset($_GET['id'])) {
//
//            $id = $_GET['id'];
//            $request = new K2FDeleteRequest();
//            $request->id = $id;
//            $this->k2FService->requestDelete($request);
//
//            View::render('Admin/ListItem/Subjig/delete', [
//                'success' => '/admin/list-item/subjig/k1a'
//            ]);
//        }
//    }
}