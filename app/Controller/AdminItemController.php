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
        $model = [
            'Title' => 'Admin | Daftar Hanger',
            'hanger_types' => $this->hangerTypeRepository->findAll(),
            'hangers' => $this->hangerRepository
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
            $response = $this->typeService->requestCreate($request)->hangerType->getId();

            View::redirect("/admin/item/$response/hanger/update");

        } catch (ValidationException $exception) {
            $model = [
                'Title' => 'Admin | Daftar Hanger',
                'error' => $exception->getMessage(),
                'hanger_types' => $this->hangerTypeRepository->findAll(),
                'hangers' => $this->hangerRepository
            ];
            View::render('Admin/Item/HangerType/index', compact('model'));
        }
    }

    public function update(string $type)
    {
        $model = [
            'find_id' => $this->hangerTypeRepository->findById($type),
            'hangers' => $this->hangerRepository->findHangerTypeId($type)
        ];
        View::render('Admin/Item/HangerType/update', compact('model'));
    }

    public function postTmp(string $type)
    {
        if (isset($_POST['updateId'])) {
            $newId = $_POST['newId'];
            try {
                $request = new HangerTypeRequest();
                $request->id = $type;
                $request->newId = $newId;
                $this->typeService->requestUpdate($request);

                $model = [
                    'success' => "/admin/item/$newId/hanger/update",
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type)
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type)
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));
            }
        } elseif (isset($_POST['updateQty'])) {
            $qty = $_POST['qty'];
            try {
                $request = new HangerTypeRequest();
                $request->id = $type;
                $request->qty = $qty;
                $this->typeService->requestUpdate($request);

                $model = [
                    'success' => "/admin/item/$type/hanger/update",
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type)
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type)
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));
            }
        }
    }

    public function postHangerRegister(string $type)
    {
        if (isset($_POST['register'])) {
            try {
                for ($i = 0; $i < count($_POST['orderNumber']); $i++) {
                    $name = $_POST['hangerName'][ $i ];
                    $qty = $_POST['qty'][ $i ];

                    $request = new HangerRequest();
                    $request->hangerTypeId = $type;
                    $request->name = $name;
                    $request->qty = $qty;
                    $this->hangerService->requestCreate($request);
                }
                $model = [
                    'success' => "/admin/item/$type/hanger/update"
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));

            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type)
                ];
                View::render('Admin/Item/HangerType/update', compact('model'));
            }
        } elseif (isset($_POST['update'])) {
            try {
                foreach ($this->hangerRepository->findHangerTypeId($type) as $key => $hanger) {
                    $orderNumber = $_POST['updateOrderNumber'][ $key ];
                    $hanger = $_POST['updateName'][ $key ];
                    $qty = $_POST['updateQty'][ $key ];

                    $request = new HangerRequest();
                    $request->hangerId = $hanger->getId();
                    $request->orderNumber = $orderNumber;
                    $request->name = $hanger;
                    $request->hangerTypeId = $type;
                    $request->qty = $qty;
                    $this->hangerService->requestUpdate($request);
                }
                $model = [
                    'success' => "/admin/item/$type/hanger/update",
                ];
                View::render('Admin/Item/HangerType/Temp/update', compact('model'));
            } catch (ValidationException $exception) {
                $model = [
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type)
                ];
                View::render('Admin/Item/HangerType/update', compact('model'));
            }
        }
    }

    public function delete(string $type, string $hanger)
    {
        $request = new HangerRequest();
        $request->hangerId = $hanger;
        $request->hangerTypeId = $type;
        try {
            $this->hangerService->requestDelete($request);

            $model = [
                'success' => "/admin/item/$type/hanger/update"
            ];
            View::render('Admin/Item/HangerType/Temp/update', compact('model'));
        } catch (\Exception $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'find_id' => $this->hangerTypeRepository->findById($type),
                'hangers' => $this->hangerRepository->findHangerTypeId($type)
            ];
            View::render('Admin/Item/HangerType/update', compact('model'));
        }
    }
}