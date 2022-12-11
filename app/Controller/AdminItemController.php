<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\HangerRequest;
use Subjig\Report\HTTP\Request\HangerTypeRequest;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\HangerService;
use Subjig\Report\Service\HangerTypeService;
use Subjig\Report\Service\SessionService;

class AdminItemController
{
    private HangerTypeService $typeService;
    private HangerTypeRepository $hangerTypeRepository;
    private HangerRepository $hangerRepository;
    private HangerService $hangerService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->hangerTypeRepository = new HangerTypeRepository($connection);
        $this->typeService = new HangerTypeService($this->hangerTypeRepository);

        $this->hangerRepository = new HangerRepository($connection);
        $this->hangerService = new HangerService($this->hangerRepository);

    }

    public function index()
    {
        View::render('Admin/ItemList/index', [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'List_Item' => 'active bg-warning',
            'Title' => 'Admin | Item',
            'hanger_types' => $this->hangerTypeRepository->findAll(),
            'hangers' => $this->hangerRepository,
            'session' => $this->sessionService->current(),
        ]);
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
            View::render('Admin/ItemList/index', [
                'Title' => 'Admin | Daftar Hanger',
                'error' => $exception->getMessage(),
                'hanger_types' => $this->hangerTypeRepository->findAll(),
                'hangers' => $this->hangerRepository,
                'session' => $this->sessionService->current(),
            ]);
        }
        exit();
    }

    public function update(string $type)
    {
        if ($this->hangerTypeRepository->findById($type) === null) {
            View::render('404');
            return;
        }
        View::render('Admin/ItemList/update', [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'List_Item' => 'active bg-warning',
            'Title' => 'Admin | Item',
            'find_id' => $this->hangerTypeRepository->findById($type),
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'session' => $this->sessionService->current(),
        ]);
    }

    public function postUpdateType(string $type)
    {
        if ($this->hangerTypeRepository->findById($type) === null) {
            View::render('404');
            return;
        }

        if (isset($_POST['updateId'])) {
            $newId = $_POST['newId'];
            try {
                $request = new HangerTypeRequest();
                $request->id = $type;
                $request->newId = $newId;
                $this->typeService->requestUpdate($request);

                View::render('Admin/ItemList/Temp/update', [
                    'direct' => "/admin/item/$newId/hanger/update",
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type),
                    'session' => $this->sessionService->current(),
                ]);

            } catch (ValidationException $exception) {
                View::render('Admin/ItemList/update', [
                    'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
                    'List_Item' => 'active bg-warning',
                    'Title' => 'Admin | Item',
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type),
                    'session' => $this->sessionService->current(),
                ]);
            }
        } elseif (isset($_POST['updateQty'])) {
            $qty = $_POST['qty'];
            try {
                $request = new HangerTypeRequest();
                $request->id = $type;
                $request->qty = $qty;
                $this->typeService->requestUpdate($request);

                View::render('Admin/ItemList/Temp/update', [
                    'direct' => "/admin/item/$type/hanger/update",
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type),
                    'session' => $this->sessionService->current(),
                ]);

            } catch (ValidationException $exception) {
                View::render('Admin/ItemList/update', [
                    'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
                    'List_Item' => 'active bg-warning',
                    'Title' => 'Admin | Item',
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type),
                    'session' => $this->sessionService->current(),
                ]);
            }
        }
    }

    public function updateHanger(string $type)
    {
        if ($this->hangerTypeRepository->findById($type) === null) {
            View::render('404');
            return;
        }

        View::render('Admin/ItemList/Temp/update', [
            'direct' => "/admin/item/$type/update",
        ]);
    }

    public function postUpdateHanger(string $type)
    {
        if ($this->hangerTypeRepository->findById($type) === null) {
            View::render('404');
            return;
        }

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
                View::render('Admin/ItemList/Temp/update', [
                    'direct' => "/admin/item/$type/hanger/update",
                    'session' => $this->sessionService->current(),
                ]);

            } catch (ValidationException $exception) {
                View::render('Admin/ItemList/update', [
                    'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
                    'List_Item' => 'active bg-warning',
                    'Title' => 'Admin | Item',
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type),
                    'session' => $this->sessionService->current(),
                ]);
            }
        } elseif (isset($_POST['update'])) {
            try {
                foreach ($this->hangerRepository->findHangerTypeId($type) as $key => $hanger) {
                    $orderNumber = $_POST['updateOrderNumber'][ $key ];
                    $hangerName = $_POST['updateName'][ $key ];
                    $qty = $_POST['updateQty'][ $key ];

                    $request = new HangerRequest();
                    $request->hangerId = $hanger->getId();
                    $request->orderNumber = $orderNumber;
                    $request->name = $hangerName;
                    $request->hangerTypeId = $type;
                    $request->qty = $qty;
                    $this->hangerService->requestUpdate($request);
                }
                View::redirect("/admin/item/$type/hanger/update");
            } catch (ValidationException $exception) {
                View::render('Admin/ItemList/update', [
                    'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
                    'List_Item' => 'active bg-warning',
                    'Title' => 'Admin | Item',
                    'error' => $exception->getMessage(),
                    'find_id' => $this->hangerTypeRepository->findById($type),
                    'hangers' => $this->hangerRepository->findHangerTypeId($type),
                    'session' => $this->sessionService->current(),
                ]);
            }
        }
        exit();
    }

    public function delete(string $type, string $hanger)
    {
        if ($this->hangerTypeRepository->findById($type) === null || $this->hangerRepository->findById($hanger) === null) {
            View::render('404');
            return;
        }

        $request = new HangerRequest();
        $request->hangerId = $hanger;
        $request->hangerTypeId = $type;
        try {
            $this->hangerService->requestDelete($request);

            View::render('Admin/ItemList/Temp/delete', [
                'direct' => "/admin/item/$type/hanger/update"
            ]);
        } catch (\Exception $exception) {
            View::render('Admin/ItemList/Temp/delete', [
                'error' => $exception->getMessage(),
                'direct' => "/admin/item/$type/hanger/update",
                'find_id' => $this->hangerTypeRepository->findById($type),
                'hangers' => $this->hangerRepository->findHangerTypeId($type),
                'session' => $this->sessionService->current(),
            ]);
        }
    }
}
