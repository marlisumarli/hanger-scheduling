<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Repository\LineRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\SubjigRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\TypeRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\LineService;
use Subjig\Report\Service\SessionService;
use Subjig\Report\Service\SupplyService;


class SupplyController
{
    private TypeRepository $typeRepository;
    private SubjigRepository $subjigRepository;
    private SupplyService $supplyService;
    private SupplyRepository $supplyRepository;
    private LineService $lineService;
    private LineRepository $lineRepository;
    private SessionService $sessionService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
        $this->typeRepository = new TypeRepository(Database::getConnection());
        $this->subjigRepository = new SubjigRepository(Database::getConnection());
        $this->lineRepository = new LineRepository(Database::getConnection());
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->lineService = new LineService($this->lineRepository);
        $this->supplyService = new SupplyService($this->supplyRepository);
    }

    public function index()
    {
        $fullName = new UserDetailRepository(Database::getConnection());
        $model = [
            'title' => 'Admin | Supply',
            'allType' => $this->typeRepository->findAll(),
            'supply' => 'active',
            'fullName' => Util::nameSplitter($fullName->findByUsername($this->sessionService->current()->getUsername())->getFullName())
        ];
        View::render('Admin/Supply/index', compact('model'));
    }

    public function create(string $id)
    {
        $model = [
            'title' => "Admin | Supply $id",
            'allSubjig' => $this->subjigRepository->data($id),
        ];
        View::render('Admin/Supply/Subjig/index', compact('model'));
    }

    public function postCreate(string $id)
    {
        $allSubjig = $this->subjigRepository->data($id);
        $date = $_POST['date'];

        try {
            $createSup = new SupplyRequest();
            $createSup->supplyId = str_replace(array("-", ":", "/"), '', $date) . $id;
            $createSup->typeId = $id;
            $createSup->supplyDate = $date;
            $createSup->supplyTarget = $_POST['target'];
            $this->supplyService->requestCreate($createSup);

            foreach ($allSubjig as $key => $value) {
                $createLine = new SupplyRequest();
                $createLine->supplyId = $createSup->supplyId;
                $createLine->subjigId = $value->getSubjigId();
                $createLine->jumlahLineA = $_POST['lnA'][ $key ];
                $createLine->jumlahLineB = $_POST['lnB'][ $key ];
                $createLine->jumlahLineC = $_POST['lnC'][ $key ];
                $createLine->supplyTarget = $createSup->supplyTarget;
                $this->lineService->requestCreate($createLine);
            }
            $model = [
                'title' => "Admin | Supply $id",
                'success' => "/admin/laporan/$id/supply",
                'allSubjig' => $this->subjigRepository->data($id),
            ];
            View::render('Admin/Supply/Subjig/index', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Supply K2F',
                'error' => $exception->getMessage(),
                'allSubjig' => $this->subjigRepository->data($id),
            ];
            View::render('Admin/Supply/Subjig/index', compact('model'));
        }
    }

    public function update(string $type, string $id)
    {
        $model = [
            'title' => "Admin | Update Supply $id",
            'idSupply' => $this->supplyRepository->findById($id),
            'allSupply' => $this->supplyRepository->allSupplyLine($id),
            'back' => $type
        ];
        View::render('Admin/Supply/Subjig/update', compact('model'));
    }

    public function postUpdate(string $type, string $id)
    {
        $allSupply = $this->supplyRepository->allSupplyLine($id);
        $date = $_POST['dateUpdate'];

        try {
            $updateSup = new SupplyRequest();
            $updateSup->supplyId = $id;
            $updateSup->supplyDate = $date;
            $updateSup->supplyTarget = $_POST['target'];
            $this->supplyService->requestUpdate($updateSup);

            foreach ($allSupply as $key => $value) {
                $createLine = new SupplyRequest();
                $createLine->lineId = $value->getSupplyLineId();
                $createLine->jumlahLineA = $_POST['lnA'][ $key ];
                $createLine->jumlahLineB = $_POST['lnB'][ $key ];
                $createLine->jumlahLineC = $_POST['lnC'][ $key ];
                $createLine->supplyTarget = $updateSup->supplyTarget;
                $this->lineService->requestUpdate($createLine);
            }
            $model = [
                'title' => "Admin | Update Supply $id",
                'success' => "/admin/supply/$type/$id/update",
                'idSupply' => $this->supplyRepository->findById($id),
                'allSupply' => $this->supplyRepository->allSupplyLine($id)
            ];
            View::render('Admin/Supply/Subjig/update', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'title' => "Admin | $id",
            ];
            View::render('Admin/Supply/Subjig/update', compact('model'));
        }
    }

    public function delete(string $type, string $id)
    {
        $request = new SupplyRequest();
        $request->supplyId = $id;
        $this->supplyService->requestDelete($request);

        $model = [
            'success' => "/admin/laporan/$type/supply"
        ];
        View::render('Admin/Supply/Subjig/delete', compact('model'));
    }
}