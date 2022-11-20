<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\TypeRequest;
use Subjig\Report\Repository\TypeRepository;
use Subjig\Report\Service\TypeService;

class ListItemController
{
    private TypeService $typeService;
    private TypeRepository $typeRepository;

    public function __construct()
    {
        $this->typeRepository = new TypeRepository(Database::getConnection());
        $this->typeService = new TypeService($this->typeRepository);
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | Daftar Subjig'
        ];
        View::render('Admin/ListItem/index', compact('model'));
    }

    public function typeItem()
    {
        $model = [
            'title' => 'Admin | Daftar Subjig',
            'allType' => $this->typeRepository->findAll()
        ];
        View::render('Admin/TypeItem/index', compact('model'));
    }

    public function postCreateType()
    {
        $id = $_POST['id'];
        $qty = $_POST['qty'];

        $request = new TypeRequest();
        $request->id = $id;
        $request->qty = $qty;
        try {
            $this->typeService->requestCreate($request);
            View::redirect("/admin/subjig/$id/list");
        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Daftar Subjig',
                'error' => $exception->getMessage(),
                'allType' => $this->typeRepository->findAll()
            ];
            View::render('Admin/TypeItem/index', compact('model'));
        }
    }

    public function postUpdateType()
    {
        if (isset($_POST['updateId'])) {
            $id = $_GET['id'];
            $newId = $_POST['newId'];
            try {
                $request = new TypeRequest();
                $request->newId = $newId;
                $request->id = $id;
                $this->typeService->requestUpdate($request);

                $model = [
                    'success' => '/admin/list-item/subjig'
                ];
                View::render('Admin/TypeItem/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'allType' => $this->typeRepository->findAll()
                ];
                View::render('Admin/TypeItem/index', compact('model'));
            }
        } elseif (isset($_POST['updateQty'])) {
            $id = $_GET['id'];
            $qty = $_POST['qty'];
            try {
                $request = new TypeRequest();
                $request->id = $id;
                $request->qty = $qty;
                $this->typeService->requestUpdate($request);

                $model = [
                    'success' => '/admin/list-item/subjig'
                ];
                View::render('Admin/TypeItem/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'allType' => $this->typeRepository->findAll()
                ];
                View::render('Admin/TypeItem/index', compact('model'));
            }
        }
    }

}