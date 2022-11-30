<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\HangerRequest;
use Subjig\Report\HTTP\Request\HangerTypeRequest;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Service\HangerService;
use Subjig\Report\Service\HangerTypeService;

class AdminItemController
{
    private HangerTypeService $typeService;
    private HangerTypeRepository $hangerTypeRepository;
    private HangerRepository $hangerRepository;
    private HangerService $hangerService;

    public function __construct()
    {
        $this->hangerTypeRepository = new HangerTypeRepository(Database::getConnection());
        $this->typeService = new HangerTypeService($this->hangerTypeRepository);

        $this->hangerRepository = new HangerRepository(Database::getConnection());
        $this->hangerService = new HangerService($this->hangerRepository);
    }

    public function index()
    {
        $result = [];
        foreach ($this->hangerTypeRepository->findAll() as $key => $value) {
            $result[] = $this->hangerRepository->data($value->getId());
        }

        $model = [
            'title' => 'Admin | Daftar Hanger',
            'allHangerType' => $this->hangerTypeRepository->findAll(),
            'allHanger' => $result
        ];
        View::render('Admin/Item/HangerType/index', compact('model'));
    }

    public function postRegister()
    {
        $id = $_POST['id'];
        $qty = $_POST['qty'];

        $request = new HangerTypeRequest();
        $request->id = $id;
        $request->qty = $qty;
        try {
            $this->typeService->requestCreate($request);
            View::redirect("/admin/item/$id/hanger/update");
        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Daftar Hanger',
                'error' => $exception->getMessage(),
                'allType' => $this->hangerTypeRepository->findAll(),
            ];
            View::render('Admin/Item/HangerType/index', compact('model'));
        }
    }

    public function update(string $id)
    {
        $model = [
            'findType' => $this->hangerTypeRepository->findById($id),
            'allHanger' => $this->hangerRepository->data($id)
        ];
        View::render('Admin/Item/HangerType/update', compact('model'));
    }

    public function postTmp(string $id)
    {
        if (isset($_POST['updateId'])) {
            $newId = $_POST['newId'];
            try {
                $request = new HangerTypeRequest();
                $request->newId = $newId;
                $request->id = $id;
                $this->typeService->requestUpdate($request);

                $model = [
                    'success' => "/admin/item/$newId/hanger/update",
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'findType' => $this->hangerTypeRepository->findById($id),
                    'allHanger' => $this->hangerRepository->data($id)
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));
            }
        } elseif (isset($_POST['updateQty'])) {
            $qty = $_POST['qty'];
            try {
                $request = new HangerTypeRequest();
                $request->id = $id;
                $request->qty = $qty;
                $this->typeService->requestUpdate($request);

                $model = [
                    'success' => "/admin/item/$id/hanger/update",
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'findType' => $this->hangerTypeRepository->findById($id),
                    'allHanger' => $this->hangerRepository->data($id)
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));
            }
        }
    }

    public function postHangerRegister(string $id)
    {
        if (isset($_POST['register'])) {
            try {
                for ($i = 0; $i < count($_POST['orderNumber']); $i++) {
                    $hangerName = $_POST['hangerName'][ $i ];
                    $qty = $_POST['qty'][ $i ];

                    $request = new HangerRequest();
                    $request->hangerTypeId = $id;
                    $request->name = $hangerName;
                    $request->qty = $qty;
                    $this->hangerService->requestCreate($request);
                }
                $model = [
                    'success' => "/admin/item/$id/hanger/update"
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'title' => "Admin | Hanger $id",
                    'error' => $exception->getMessage(),
                    'findType' => $this->hangerTypeRepository->findById($id),
                    'allHanger' => $this->hangerRepository->data($id)
                ];
                View::render('Admin/Item/HangerType/update', compact('model'));
            }
        } elseif (isset($_POST['update'])) {
            try {
                foreach ($this->hangerRepository->data($id) as $key => $value) {
                    $orderNumber = $_POST['updateOrderNumber'][ $key ];
                    $hangerName = $_POST['updateName'][ $key ];
                    $qty = $_POST['updateQty'][ $key ];

                    $request = new HangerRequest();
                    $request->hangerId = $value->getHangerId();
                    $request->orderNumber = $orderNumber;
                    $request->name = $hangerName;
                    $request->hangerTypeId = $id;
                    $request->qty = $qty;
                    $this->hangerService->requestUpdate($request);
                }
                $model = [
                    'success' => "/admin/item/$id/hanger/update",
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));
            } catch (ValidationException $exception) {
                $model = [
                    'title' => "Admin | Hanger $id",
                    'error' => $exception->getMessage(),
                    'findType' => $this->hangerTypeRepository->findById($id),
                    'allHanger' => $this->hangerRepository->data($id)
                ];
                View::render('Admin/Item/HangerType/update', compact('model'));
            }
        }
    }

    public function delete(string $idHT, string $id)
    {
        $request = new HangerRequest();
        $request->hangerId = $id;
        $request->hangerTypeId = $idHT;
        try {
            $this->hangerService->requestDelete($request);

            $model = [
                'success' => "/admin/item/$idHT/hanger/update"
            ];
            View::render('Admin/Item/HangerType/Temp/update', compact('model'));
        } catch (\Exception $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'findType' => $this->hangerTypeRepository->findById($idHT),
                'allHanger' => $this->hangerRepository->data($idHT)
            ];
            View::render('Admin/Item/HangerType/update', compact('model'));
        }
    }
}