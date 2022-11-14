<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\K2FRequest;
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
        $model = [
            'title' => 'Admin | Daftar Subjig'
        ];
        View::render('Admin/ListItem/index', compact('model'));
    }

    public function subjig()
    {
        $model = [
            'title' => 'Admin | Daftar Subjig'
        ];
        View::render('Admin/ListItem/Subjig/index', compact('model'));
    }

    public function k2f()
    {
        $model = [
            'title' => 'Admin | Subjig K2F',
            'allK2f' => $this->k2FRepository->findAll()
        ];
        View::render('Admin/ListItem/Subjig/k2f', compact('model'));
    }

    public function postK2f()
    {

        try {
            for ($i = 0; $i < count($_POST['id']); $i++) {
                $id = $_POST['id'][ $i ];
                $name = $_POST['name'][ $i ];
                $qty = $_POST['qty'][ $i ];

                $k2f = new K2FRequest();
                $k2f->id = $this->k2FRepository::TYPE . $id;
                $k2f->name = $name;
                $k2f->qty = $qty;
                $this->k2FService->requestCreate($k2f);
            }
            View::redirect('/admin/list-item/subjig/k2f');

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | K2F',
                'error' => $exception->getMessage(),
                'allK2f' => $this->k2FRepository->findAll()
            ];
            View::render('Admin/ListItem/Subjig/k2f', compact('model'));
        }
    }

    public function updateK2f()
    {
        $result = $this->k2FRepository->findById($_GET['id']);
        $model = [
            'title' => 'Admin | Update Subjig K2F',
            'type' => $this->k2FRepository::TYPE,
            'id' => $_GET['id'],
            'name' => $result->k2f_name,
            'qty' => $result->k2f_qty,
        ];
        View::render('Admin/ListItem/Subjig/update', compact('model'));
    }

    public function postUpdateK2f()
    {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $k2f = new K2FRequest();
        $k2f->id = $id;
        $k2f->name = $name;
        $k2f->qty = $qty;

        try {
            $this->k2FService->requestUpdate($k2f);
            $model = [
                'title' => 'Admin | Update K2F',
                'success' => "$k2f->id : Berhasil diubah",
                'type' => $this->k2FRepository::TYPE,
                'id' => $k2f->id,
                'name' => $k2f->name,
                'qty' => $k2f->qty,
            ];
            View::render('Admin/ListItem/Subjig/update', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Update K2F',
                'error' => $exception->getMessage(),
                'type' => $this->k2FRepository::TYPE,
                'id' => $k2f->id,
                'name' => $k2f->name,
                'qty' => $k2f->qty,
            ];
            View::render('Admin/ListItem/Subjig/update', compact('model'));
        }
    }

    public function updateOrderedK2f()
    {
        $model = [
            'title' => 'Admin | Subjig K2F',
            'allK2f' => $this->k2FRepository->findAll()
        ];
        View::render('Admin/ListItem/Subjig/update-ordered', compact('model'));
    }

    public function postUpdateOrderedK2f()
    {
        for ($i = 0; $i < count($_POST['id']); $i++) {
            $id = $_POST['id'][ $i ];
            $oId = $_POST['order'][ $i ];

            $k2f = new K2FRequest();
            $k2f->id = $id;
            $k2f->oId = $oId;
            $this->k2FService->requestUpdateOrder($k2f);
        }
    }

    public function deleteK2f()
    {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $request = new K2FRequest();
            $request->id = $id;
            $this->k2FService->requestDelete($request);

            $model = [
                'success' => '/admin/list-item/subjig/k2f'
            ];
            View::render('Admin/ListItem/Subjig/delete', compact('model'));
        }
    }

//    TODO K1A
}