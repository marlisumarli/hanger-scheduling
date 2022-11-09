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
            'title' => 'Daftar | Subjig'
        ]);
    }

    public function subjig()
    {
        View::render('Admin/ListItem/Subjig/index', [
            'title' => 'Daftar | Subjig'
        ]);
    }

    public function k2f()
    {
        View::render('Admin/ListItem/Subjig/k2f', [
            'title' => 'k2f',
            'k2f' => $this->k2FRepository->findAll()
        ]);
    }

    public function postK2f()
    {
        $code = $_POST['code'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $k2f = new K2FCreateRequest();
        $k2f->code = $this->k2FRepository::TYPE . $code;
        $k2f->name = $name;
        $k2f->qty = $qty;
        try {
            $this->k2FService->requestCreate($k2f);
            View::redirect('/admin/list-item/subjig/k2f');
        } catch (ValidationException $exception) {
            View::render('Admin/ListItem/Subjig/k2f', [
                'title' => 'k2f',
                'error' => $exception->getMessage(),
                'k2f' => $this->k2FRepository->findAll()
            ]);
        }
    }

    public function editK2f()
    {
        $result = $this->k2FRepository->findByCode($_GET['code']);
        View::render('Admin/ListItem/Subjig/edit', [
            'title' => 'Update K2F',
            'type' => $this->k2FRepository::TYPE,
            'id' => $_GET['code'],
            'name' => $result->name,
            'qty' => $result->qty,
        ]);
    }

    public function postUpdateK2f()
    {
        $name = $_POST['name'];
        $qty = $_POST['qty'];

        $k2f = new K2FUpdateRequest();
        $k2f->code = $_GET['code'];
        $k2f->name = $name;
        $k2f->qty = $qty;
        try {
            $this->k2FService->requestUpdate($k2f);
            View::render('Admin/ListItem/Subjig/edit', [
                'success' => "$k2f->code : Berhasil diubah",
                'title' => 'Update K2F',
                'type' => $this->k2FRepository::TYPE,
                'id' => $_GET['code'],
                'name' => $k2f->name,
                'qty' => $k2f->qty,
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/ListItem/Subjig/edit', [
                'title' => 'k2f',
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function delete()
    {
        if (isset($_GET['code'])) {

            $code = $_GET['code'];
            $request = new K2FDeleteRequest();
            $request->code = $code;
            $this->k2FService->requestDelete($request);

            View::render('Admin/ListItem/Subjig/delete', [
                'success' => '/admin/list-item/subjig/k2f'
            ]);
        }
    }
}